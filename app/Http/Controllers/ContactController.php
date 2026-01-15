<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
use Illuminate\Support\Str;
use App\Mail\ContactSended;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('created_at', 'desc')
        ->get();
        return view('contacts.index')->with([
            'contacts' => $contacts
        ]);
    }

    public function contact(){
        return view('front.contact.index');
    }

    public function view($id){
        $contact = Contact::where("id", $id)
        ->orderBy('created_at', 'desc')
        ->first();
        
        return view('contacts.view')->with([
            'contact' => $contact
        ]);
    }

    public function contactSend(Request $request){
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        $errors = array();

        // $request->validate([
        //     'g-recaptcha-response' => 'required|captcha'
        // ]);

        $newContact = new Contact();
        $fields = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];

        if(!isset($name)){
            array_push($errors, __('messages.name_required'));
        }
        if(!isset($email)){
            array_push($errors, __('messages.email_required'));
        }
        if(!isset($message)){
            array_push($errors, __('messages.message_required'));
        }

        if(
            isset($request->name) && 
            isset($request->email) &&
            isset($request->message)
        ){
            if ($request->my_honeypot !== '' && $request->my_honeypot !== null) {
                $status = false;
                return redirect()->back()->withInput()->withErrors("robot error");
            }
            $newContact = $newContact->create($fields);  

            if($newContact){
                $mail = Mail::to(env('MAIL_TO_ADDRESS'))
                ->send(new ContactSended($fields));
                return redirect()->back()->with(['success' => __('messages.sent_successfully')]);
          }else{
            return redirect()->back()->withInput()->withErrors($errors);
          }
        }else{
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function contactSendApi(Request $request)
    {
        // Step 1: Honeypot validation (before other validations)
        $honeypotFields = ['website_url', 'phone_number', 'my_honeypot'];
        foreach ($honeypotFields as $field) {
            if (!empty($request->input($field))) {
                return response()->json([
                    'status' => 422,
                    'message' => 'validation_error',
                    'errors' => [
                        'form' => ['Bot detected. Submission rejected.']
                    ]
                ], 422);
            }
        }

        // Step 2: Time-based validation
        $formLoadTimestamp = $request->input('form_load_timestamp');
        if (!$formLoadTimestamp) {
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => [
                    'form_load_timestamp' => ['Form timestamp is required.']
                ]
            ], 422);
        }

        $currentTime = time();
        $timeElapsed = $currentTime - (int)$formLoadTimestamp;

        // Minimum 5 seconds (prevents instant bot submissions)
        if ($timeElapsed < 5) {
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => [
                    'form_load_timestamp' => ['Form submission too fast. Please take your time filling the form.']
                ]
            ], 422);
        }

        // Maximum 3600 seconds (1 hour, prevents stale submissions)
        if ($timeElapsed > 3600) {
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => [
                    'form_load_timestamp' => ['Form session expired. Please refresh and try again.']
                ]
            ], 422);
        }

        // Step 3: JavaScript challenge validation
        $jsToken = $request->input('js_token');
        if (!$jsToken) {
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => [
                    'js_token' => ['JavaScript challenge token is required.']
                ]
            ], 422);
        }

        // Validate JS token: hash of timestamp + APP_KEY
        // Note: $formLoadTimestamp comes from request->input() which may be string or number
        // PHP's . operator converts number to string, so we ensure it's a string
        $appKey = config('app.key');
        $tokenString = (string)$formLoadTimestamp . $appKey;
        $expectedToken = hash('sha256', $tokenString);
        
        // Debug logging (remove in production)
        if (config('app.debug')) {
            Log::debug('JS Token validation', [
                'form_load_timestamp' => $formLoadTimestamp,
                'timestamp_type' => gettype($formLoadTimestamp),
                'app_key_length' => strlen($appKey),
                'app_key_prefix' => substr($appKey, 0, 20),
                'token_string_length' => strlen($tokenString),
                'token_string_prefix' => substr($tokenString, 0, 30),
                'expected_token' => $expectedToken,
                'received_token' => $jsToken,
                'tokens_match' => $jsToken === $expectedToken,
            ]);
        }
        
        if ($jsToken !== $expectedToken) {
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => [
                    'js_token' => ['Invalid security token. Please refresh and try again.']
                ]
            ], 422);
        }

        // Step 4: Standard field validation
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:5000',
            ], [
                'name.required' => __('messages.name_required'),
                'email.required' => __('messages.email_required'),
                'email.email' => 'Please provide a valid email address.',
                'message.required' => __('messages.message_required'),
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => $validationException->errors()
            ], 422);
        }

        // Step 5: Create contact record
        try {
            $fields = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
            ];

            $newContact = Contact::create($fields);

            if ($newContact) {
                // Send email notification
                try {
                    Mail::to(env('MAIL_TO_ADDRESS'))
                        ->send(new ContactSended($fields));
                } catch (\Exception $mailException) {
                    // Log mail error but don't fail the request
                    Log::error('Contact form email failed: ' . $mailException->getMessage());
                }

                return response()->json([
                    'status' => 200,
                    'message' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'status' => 422,
                    'message' => 'validation_error',
                    'errors' => [
                        'form' => ['Failed to save contact. Please try again.']
                    ]
                ], 422);
            }
        } catch (\Exception $exception) {
            Log::error('Contact form submission error: ' . $exception->getMessage());
            
            return response()->json([
                'status' => 422,
                'message' => 'validation_error',
                'errors' => [
                    'form' => ['An error occurred. Please try again later.']
                ]
            ], 422);
        }
    }   
}
