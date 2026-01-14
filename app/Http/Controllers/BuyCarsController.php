<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BuyCarsService;
use App\Services\UserService;

class BuyCarsController extends Controller
{
    private $buyCarsService;
    private $userService;

    public function __construct(BuyCarsService $buyCarsService, UserService $userService,)
    {
        $this->userService = $userService;
        $this->buyCarsService = $buyCarsService;
    }

    public function categories(){
        return view('buy-cars.categories.index')->with([
            'categories' => $this->buyCarsService->getCategories()
        ]);
    }

    public function categoriesCreate(){
        return view('buy-cars.categories.create');
    }

    public function categoriesEdit($id){
        return view('buy-cars.categories.edit')->with([
            'category' => $this->buyCarsService->getCategoryByID($id)
        ]);
    }

    public function categoriesUpdate(Request $request){
        return $this->buyCarsService->getUpdate($request);
    }

    public function deleteCategoryWithID(Request $request){
        return $this->buyCarsService->deleteCategoryByID($request);
    }

    // Marks
    public function marks(){
        return view('buy-cars.marks.index')->with([
            'marks' => $this->buyCarsService->getMarks()
        ]);
    }

    public function marksCreate(){
        return view('buy-cars.marks.create');
    }

    public function marksEdit($id){
        return view('buy-cars.marks.edit')->with([
            'mark' => $this->buyCarsService->getMarkByID($id)
        ]);
    }

    public function updateMark(Request $request){
        return $this->buyCarsService->getUpdateMark($request);
    }

    public function deleteMarkWithID(Request $request){
        return $this->buyCarsService->getDeleteMarkByID($request);
    }
    // End of marks

    public function models(){
        return view('buy-cars.models.index')->with([
            'models' => $this->buyCarsService->getModels()
        ]);
    }

    public function modelsCreate(){
        return view('buy-cars.models.create')
        ->with([
            'marks' => $this->buyCarsService->getMarks()
        ]);
    }

    public function updateModel(Request $request){
        return $this->buyCarsService->getUpdateModel($request);
    }

    public function modelsEdit($id){
        return view('buy-cars.models.edit')
        ->with(
            [
                'marks' => $this->buyCarsService->getMarks(),
                'model' => $this->buyCarsService->getModelByID($id),
            ]
        );
    }

    public function deleteModelWithID(Request $request){
        return $this->buyCarsService->getDeleteModelByID($request);
    }

    // Cars
    public function cars(){
        return $this->buyCarsService->getCars(); 
    }

    public function updateCars(Request $request){
        return $this->buyCarsService->getUpdateCars($request); 
    }

    public function createCar(){
        return $this->buyCarsService->getCreateCarView(); 
    }

    public function modelsByMark($mark_id){
        return $this->buyCarsService->getModelsByMark($mark_id); 
    }

    public function buyCarsEdit($id){
        return $this->buyCarsService->getBuyCarsEdit($id); 
    }

    public function buyCarsDelete(Request $request){
        return $this->buyCarsService->getBuyCarsDelete($request);
    }
}
