<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
use Illuminate\Support\Str;
use App\Mail\ContactSended;
use Mail;
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

        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);

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
}
