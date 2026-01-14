<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AutoRentalService;
use App\Services\UserService;

class AutoRentalController extends Controller
{
    private $userService;
    private $autoRentalService;

    public function __construct(UserService $userService, AutoRentalService $autoRentalService)
    {
        $this->userService = $userService;
        $this->autoRentalService = $autoRentalService;
    }

    public function index(){
        return $this->autoRentalService->getIndex();
    }

    public function create(Request $request){
        if($this->userService->isAdmin()){
            return $this->autoRentalService->getCreate($request);
        }else{
            $this->userService->abortForbiden();
        }
    }

    public function edit($id){
        if($this->userService->isAdmin()){
            return $this->autoRentalService->getEdit($id);
        }else{
            $this->userService->abortForbiden();
        }
    }

    public function delete(Request $request){
        if($this->userService->isAdmin()){
            return $this->autoRentalService->getDelete($request);
        }else{
            $this->userService->abortForbiden();
        }
    }

    public function update(Request $request){
        if($this->userService->isAdmin()){
            return $this->autoRentalService->getUpdate($request);
        }else{
            $this->userService->abortForbiden();
        }
    }

    // Front End
    public function search(Request $request){
        return $this->autoRentalService->getSearch($request);
    }

    public function car($id){
        return $this->autoRentalService->getCar($id);
    }
}
