<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientCarService;
use App\Services\UserService;

class ClientCarController extends Controller
{
    private $clientCarService;
    private $userService;

    public function __construct(ClientCarService $clientCarService, UserService $userService,)
    {
        $this->userService = $userService;
        $this->clientCarService = $clientCarService;
    }

    public function index(){
        return $this->clientCarService->getIndex();
    }

    public function create(){
        return $this->clientCarService->getCreate();
    }

    public function update(Request $request){
        return $this->clientCarService->getUpdate($request);
    }

    public function edit($id){
        return $this->clientCarService->getEdit($id);
    }

    public function destroy(Request $request){
        return $this->clientCarService->getDestroy($request);
    }

    public function carsByClient($client_id){
        return $this->clientCarService->getCarsByClient($client_id);
    }
}
