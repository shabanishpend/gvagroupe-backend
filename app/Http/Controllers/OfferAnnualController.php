<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\OfferAnnualService;

class OfferAnnualController extends Controller
{
    private $userService;
    private $offresService;

    public function __construct(UserService $userService, OfferAnnualService $offresService)
    {
        $this->userService = $userService;
        $this->offresService = $offresService;
    }

    public function index($website){
        return $this->offresService->getIndex($website);
    }

    public function create($website){
        return $this->offresService->getCreate($website);
    }
    public function edit($id){
        return $this->offresService->getEdit($id);
    }

    public function update(Request $request, $website){
        return $this->offresService->getUpdate($request, $website);
    }

    public function destroy(Request $request){
        return $this->offresService->getDestroy($request);
    }

    public function preview(Request $request){
        return $this->offresService->getPreview($request);
    }

    public function download(Request $request){
        return $this->offresService->getDownload($request);
    }
}
