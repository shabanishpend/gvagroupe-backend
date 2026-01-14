<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServiceReservationService;

class ServiceController extends Controller
{
    private $reservationService;

    public function __construct(ServiceReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function save(Request $request){
        return $this->reservationService->getSave($request);
    }

    public function autoServiceReservation(Request $request){
        return $this->reservationService->getAutoServiceReservation($request);
    }

    public function index(Request $request){
        return $this->reservationService->getIndex($request);
    }

    public function serviceLimusine(Request $request){
        return $this->reservationService->getServiceLimusine($request);
    }
    
}
