<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BonLivrasionService;

class BonLivrasionController extends Controller
{

    private $bonLivrasionService;

    public function __construct(BonLivrasionService $bonLivrasionService)
    {
        $this->bonLivrasionService = $bonLivrasionService;
    }

    public function index($website){
        return $this->bonLivrasionService->getIndex($website);
    }

    public function create($website){
        return $this->bonLivrasionService->getCreate($website);
    }

    public function edit($id){
        return $this->bonLivrasionService->getEdit($id);
    }

    public function destroy(Request $request){
        return $this->bonLivrasionService->getDestroy($request);
    }

    public function update(Request $request, $website){
        return $this->bonLivrasionService->getUpdate($request, $website);
    }

    public function preview(Request $request){
        return $this->bonLivrasionService->getPreview($request);
    }

    public function download(Request $request){
        return $this->bonLivrasionService->getDownload($request);
    }
}
