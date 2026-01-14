<?php

namespace App\Http\Controllers;
use Newsletter;
use Illuminate\Http\Request;
use App\Models\NewsletterEmail;

class NewsLetterController extends Controller
{
    public function create()
    {
        // return view('newsletter');
    }

    public function store(Request $request)
    {
        $newsletter = new NewsletterEmail();
        $message = "";
        $status = 200;
        
        $emailExists = NewsletterEmail::where('email', $request->email)->exists();
        if(isset($request->email)){
           if($emailExists){
                $message = "exists";
                $status = 422;
           }else{
            $newsletter = $newsletter->create([
                "email" => $request->email,
            ]);
            if($newsletter){
                $message = "success";
                $status = 200;
            }else{
                $message = "error";
                $status = 422;
            }
           }
        }else{
            $message = "error";
            $status = 422;
        }

        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }
}
