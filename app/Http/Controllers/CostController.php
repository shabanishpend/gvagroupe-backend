<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CostService;

class CostController extends Controller
{
    private $userService;
    private $costService;

    public function __construct(UserService $userService, CostService $costService)
    {
        $this->userService = $userService;
        $this->costService = $costService;
    }

    public function index(){
        return $this->costService->getIndex();
    }

    public function create(){
        return $this->costService->getCreate();
    }

    public function edit($id){
        return $this->costService->getEdit($id);
    }

    public function update(Request $request){
        return $this->costService->getUpdate($request);
    }

    public function destroy(Request $request){
        return $this->costService->getDestroy($request);
    }

    // Categories
    public function indexCategory(){
        return $this->costService->getIndexCategory();
    }

    public function createCategory(){
        return $this->costService->getCreateCategory();
    }

    public function editCategory($id){
        return $this->costService->getEditCategory($id);
    }

    public function updateCategory(Request $request){
        return $this->costService->getUpdateCategory($request);
    }

    public function destroyCategory(Request $request){
        return $this->costService->getDestroyCategory($request);
    }

    // Sub Categories
    public function indexCategorySub(){
        return $this->costService->getIndexCategorySub();
    }

    public function createCategorySub(){
        return $this->costService->getCreateCategorySub();
    }

    public function editCategorySub($id){
        return $this->costService->getEditCategorySub($id);
    }

    public function updateCategorySub(Request $request){
        return $this->costService->getUpdateCategorySub($request);
    }

    public function destroyCategorySub(Request $request){
        return $this->costService->getDestroyCategorySub($request);
    }

    // API
    public function getCostsByYear($year, $website){
        return $this->costService->costsByYear($year, $website);
    }

    public function categoriesSubApi(Request $request, $website){
        return $this->costService->getCategoriesSubApi($request, $website);
    }
}
