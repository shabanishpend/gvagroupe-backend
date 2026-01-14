<?php

namespace App\Services;
use App\Models\Activity;
use App\Models\ServiceReservation;
use Mail;
use App\Mail\ServiceReservationMail;

class ServiceReservationService{

    public function getSave($request){

        $status = null;
        $message = null;

        $request->validate([
            'type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'prefered_date' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'car_brand' => 'required',
            'car_model' => 'required',
            'registration_number' => 'required',
        ]);

        $date = date('Y-m-d', strtotime($request->prefered_date));

        $fields = [
            'type' => $request->type,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date' => $date,
            'time' => $request->time,
            'comment' => $request->comment,
            'email' => $request->email,
            'phone' => $request->phone,
            'car_brand' => $request->car_brand,
            'car_model' => $request->car_model,
            'status' => 0,
            'registration_number' => $request->registration_number,
        ];

        $serviceExists = ServiceReservation::where('date', $date)
        ->where('time', $request->time)
        ->first();
        
        if($serviceExists == null){
            $service = new ServiceReservation();
            $service = $service->create($fields);
            
            if($service){
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new ServiceReservationMail($fields));
                Mail::to($request->email)->send(new ServiceReservationMail($fields));
                $status = 200;
                $message = "success";
                // return redirect()->back()->with(['service_success' => 'Successfully reserved the reservation date!']);
            }else{
                $status = 500;
                $message = "error";
                // return redirect()->back()->withInput()->with(['service_errors' => ['Error on service reservation, please try again later!']]);
            }
        }else{
            $status = 500;
            $message = "busy";
            // return redirect()->back()->withInput()->with(['service_errors' => ['This slot is busy, please select another one!']]); 
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function getAutoServiceReservation(){
        return view('front.auto-service.index');
    }

    public function getIndex($request){
        $reservations = ServiceReservation::orderBy('created_at','desc')
        ->get();
        
        return view('reservations.index')
        ->with([
            "reservations" => $reservations
        ]);
    }

    public function getServiceLimusine($request){
        return view('front.service-limusine.index');
    }
}