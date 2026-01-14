<?php

namespace App\Services;
use App\Models\Activity;
use App\Models\BuyCarsCategory;
use App\Models\BuyCarsMark;
use App\Models\BuyCarsModel;
use App\Models\BuyCarCategoryTranslation;
use App\Models\BuyCarMarksTranslation;
use App\Models\BuyCarModelsTranslation;
use App\Models\BuyCarsTranslation;
use App\Models\BuyCar;
use App\Services\ImageService;
use App\Services\UserService;
use App\Services\ActivityService;

class BuyCarsService{

    private $imageService;
    private $userService;
    private $activityService;

    public function __construct(ImageService $imageService,UserService $userService, ActivityService $activityService)
    {
        $this->imageService = $imageService;
        $this->userService = $userService;
        $this->activityService = $activityService;
    }

    // Categories
    public function getCategories(){
        $categories = BuyCarsCategory::orderBy('created_at', 'desc')
        ->get();

        return $categories;
    }

    public function getCategoryByID($id){
        $category = BuyCarsCategory::with('translation')
        ->where('id', $id)->first();

        return $category;
    }

    public function deleteCategoryByID($request){
        $category = BuyCarsCategory::where('id', $request->id)->first();
        $category = $category->delete();

        if($category > 0){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getUpdate($request){
        $request->validate([
            'name' => 'required',
        ]);

        $fields = [
            'name' => $request->name,
            'description' => $request->description
        ];

        // dd($request->all());
        if($request->type == 'create'){
            $category = new BuyCarsCategory();
            $category = $category->create($fields);
            if($category){
                $fields = [
                   'name_en' => $request->name_en,
                   'description_en' => $request->description_en,
                   'name_de' => $request->name_de,
                   'description_de' => $request->description_de,
                   'model_id' => $category->id
                ];

                $translation = new BuyCarCategoryTranslation();
                $translation = $translation->create($fields);

                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $category = BuyCarsCategory::where('id', $request->id)
            ->first();
            $update = $category->update($fields);
            if($update > 0){
                $fields = [
                    'name_en' => $request->name_en,
                    'description_en' => $request->description_en,
                    'name_de' => $request->name_de,
                    'description_de' => $request->description_de,
                    'model_id' => $category->id
                 ];

                $translation = BuyCarCategoryTranslation::where('model_id', $category->id)->first();
                if($translation == null){
                    $translation = new BuyCarCategoryTranslation();
                    $translation = $translation->create($fields);
                }else{
                    $translation = $translation->update($fields);
                }
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }
    }
    // End of categories

    // Marks
    public function getMarks(){
        $categories = BuyCarsMark::orderBy('created_at', 'desc')
        ->get();

        return $categories;
    }

    public function getMarkByID($id){
        $mark = BuyCarsMark::with('translation')->where('id', $id)->first();
        return $mark;
    }

    public function getUpdateMark($request){
        $request->validate([
            'name' => 'required',
        ]);

        $fields = [
            'name' => $request->name,
            'description' => $request->description
        ];

        if($request->type == 'create'){
            $category = new BuyCarsMark();
            $category = $category->create($fields);
            if($category){
                $fields = [
                    'name_en' => $request->name_en,
                    'description_en' => $request->description_en,
                    'name_de' => $request->name_de,
                    'description_de' => $request->description_de,
                    'model_id' => $category->id
                 ];
 
                 $translation = new BuyCarMarksTranslation();
                 $translation = $translation->create($fields);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $category = BuyCarsMark::where('id', $request->id)->first();
            $update = $category->update($fields);
            if($update > 0){
                $fields = [
                    'name_en' => $request->name_en,
                    'description_en' => $request->description_en,
                    'name_de' => $request->name_de,
                    'description_de' => $request->description_de,
                ];
                $translation = BuyCarMarksTranslation::where('model_id', $category->id)->first();
                $translation = $translation->update($fields);
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }
    }

    public function getDeleteMarkByID($request){
        $mark = BuyCarsMark::where('id', $request->id)->first();
        $mark = $mark->delete();

        if($mark > 0){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }
    //End of Marks

    public function getModels(){
        $models = BuyCarsModel::orderBy('name', 'desc')
        ->with(['mark'])
        ->get();

        return $models;
    }

    public function getUpdateModel($request){
        $request->validate([
            'name' => 'required',
            'mark' => 'required',
        ]);

        $fields = [
            'name' => $request->name,
            'buy_cars_marks_id' => $request->mark,
            'description' => $request->description
        ];

        if($request->type == 'create'){
            $model = new BuyCarsModel();
            $model = $model->create($fields);
            if($model){
                $fields = [
                    'name_en' => $request->name_en,
                    'description_en' => $request->description_en,
                    'name_de' => $request->name_de,
                    'description_de' => $request->description_de,
                    'model_id' => $model->id
                 ];
 
                 $translation = new BuyCarModelsTranslation();
                 $translation = $translation->create($fields);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $model = BuyCarsModel::where('id', $request->id)->first();
            $update = $model->update($fields);
            if($update > 0){
                $fields = [
                    'name_en' => $request->name_en,
                    'description_en' => $request->description_en,
                    'name_de' => $request->name_de,
                    'description_de' => $request->description_de,
                ];
                $translation = BuyCarModelsTranslation::where('model_id', $model->id)->first();
                $translation = $translation->update($fields);
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }

    }

    public function getModelByID($id){
        $model = BuyCarsModel::where('id', $id)->first();
        return $model;
    }

    public function getDeleteModelByID($request){
        $model = BuyCarsModel::where('id', $request->id)->first();
        $model = $model->delete();

        if($model > 0){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getCars(){
        $cars = BuyCar::orderBy('created_at', 'desc')
        ->with('category.translation')
        ->get();

        return view('buy-cars.cars.index')
        ->with([
            'cars' => $cars
        ]);
    }

    public function getBuyCarCategories(){
        $categories = BuyCarsCategory::with('translation')
        ->orderBy('name', 'asc')
        ->get();

        return $categories;
    }

    public function getBuyCarMarks(){
        $marks = BuyCarsMark::orderBy('name')
        ->get();

        return $marks;
    }

    public function getBuyCarByID($car_id){
        $car = BuyCar::where('id', $car_id)
        ->orderBy('created_at', 'desc')
        ->first();

        return $car;
    }

    public function getBuyCarsEdit($id){
        return view('buy-cars.cars.edit')
        ->with([
            'categories' => $this->getBuyCarCategories(),
            'marks' => $this->getBuyCarMarks(),
            'car' => $this->getBuyCarByID($id)
        ]);
    }

    public function getCreateCarView(){
        return view('buy-cars.cars.create')
        ->with([
            'categories' => $this->getBuyCarCategories(),
            'marks' => $this->getBuyCarMarks()
        ]);
    }

    public function getUpdateCars($request){
        $fields = [
            'name' => $request->name,
            'price' => $request->price,
            'fuel' => $request->fuel,
            'mileage' => $request->mileage,
            'transmission' => $request->transmission,
            'performance' => $request->performance,
            'seats' => $request->seats,
            'doors' => $request->doors,
            'description' => $request->description,
            'status' => $request->status,
            'year' => $request->year,
            'chasie_number' => $request->chasie_number,
            'carroserie' => $request->carroserie,
            'carroserie_code' => $request->carroserie_code,
            'expertise' => $request->expertise,
            'color' => $request->color,
            'registration_number' => $request->registration_number,
            'type_approval' => $request->type_approval,
            'cilindre' => $request->cilindre,
            'power_kw' => $request->power_kw,
            'weight_no_loaded' => $request->weight_no_loaded,
            'weight_loaded' => $request->weight_loaded,
            'weight_full_loaded' => $request->weight_full_loaded,
            'roof_weight' => $request->roof_weight,
            'emission_code' => $request->emission_code,
            'buy_cars_marks_id' => $request->mark,
            'buy_cars_models_id' => $request->model,
            'buy_cars_category' => $request->category,
        ];

        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'fuel' => 'required',
        //     'mileage' => 'required',
        //     'transmission' => 'required',
        //     // 'performance' => 'required',
        //     'seats' => 'required',
        //     'year' => 'required',
        //     'chasie_number' => 'required',
        //     'carroserie' => 'required',
        //     'carroserie_code' => 'required',
        //     'expertise' => 'required',
        //     'color' => 'required',
        //     'registration_number' => 'required',
        //     'type_approval' => 'required',
        //     'cilindre' => 'required',
        //     'power_kw' => 'required',
        //     'weight_no_loaded' => 'required',
        //     'weight_loaded' => 'required',
        //     'weight_full_loaded' => 'required',
        //     'roof_weight' => 'required',
        //     'emission_code' => 'required',
        // ]);
        
        if($request->type == 'create'){

            // $request->validate([
            //     'image_1' => 'required',
            //     'image_2' => 'required',
            //     'image_3' => 'required',
            // ]);

            $car = new BuyCar();
            $car = $car->create($fields);
            
            if($car){
                $fields = [
                    'name_en' => $request->name_en,
                    'name_de' => $request->name_de,
                    'fuel_en' => $request->fuel_en,
                    'fuel_de' => $request->fuel_de,
                    'mileage_en' => $request->mileage_en,
                    'mileage_de' => $request->mileage_de,
                    'transmission_en' => $request->transmission_en,
                    'transmission_de' => $request->transmission_de,
                    'performance_en' => $request->performance_en,
                    'performance_de' => $request->performance_de,
                    'seats_en' => $request->seats_en,
                    'seats_de' => $request->seats_de,
                    'doors_en' => $request->doors_en,
                    'doors_de' => $request->doors_de,
                    'color_en' => $request->color_en,
                    'color_de' => $request->color_de,
                    'carroserie_en' => $request->carroserie_en,
                    'carroserie_de' => $request->carroserie_de,
                    'description_en' => $request->description_en,
                    'description_de' => $request->description_de,
                    'model_id' => $car->id
                 ];
 
                 $translation = new BuyCarsTranslation();
                 $translation = $translation->create($fields);

                $this->saveImageCar('create', $car, $request->image_1, 'image_1');
                $this->saveImageCar('create', $car, $request->image_2, 'image_2');
                $this->saveImageCar('create', $car, $request->image_3, 'image_3');
                $this->saveImageCar('create', $car, $request->image_4, 'image_4');
                $this->saveImageCar('create', $car, $request->image_5, 'image_5');
                $this->saveImageCar('create', $car, $request->image_6, 'image_6');
                $this->saveImageCar('create', $car, $request->image_7, 'image_7');
                $this->saveImageCar('create', $car, $request->image_8, 'image_8');
                $this->saveImageCar('create', $car, $request->image_9, 'image_9');
                $this->saveImageCar('create', $car, $request->image_10, 'image_10');

                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $car = BuyCar::where('id', $request->id)->first();
            $this->saveImageCar('edit', $car, $request->image_1, 'image_1');
            $this->saveImageCar('edit', $car, $request->image_2, 'image_2');
            $this->saveImageCar('edit', $car, $request->image_3, 'image_3');
            $this->saveImageCar('edit', $car, $request->image_4, 'image_4');
            $this->saveImageCar('edit', $car, $request->image_5, 'image_5');
            $this->saveImageCar('edit', $car, $request->image_6, 'image_6');
            $this->saveImageCar('edit', $car, $request->image_7, 'image_7');
            $this->saveImageCar('edit', $car, $request->image_8, 'image_8');
            $this->saveImageCar('edit', $car, $request->image_9, 'image_9');
            $this->saveImageCar('edit', $car, $request->image_10, 'image_10');
       
            $update = $car->update($fields);

            $fields = [
                'name_en' => $request->name_en,
                'name_de' => $request->name_de,
                'fuel_en' => $request->fuel_en,
                'fuel_de' => $request->fuel_de,
                'mileage_en' => $request->mileage_en,
                'mileage_de' => $request->mileage_de,
                'transmission_en' => $request->transmission_en,
                'transmission_de' => $request->transmission_de,
                'performance_en' => $request->performance_en,
                'performance_de' => $request->performance_de,
                'seats_en' => $request->seats_en,
                'seats_de' => $request->seats_de,
                'doors_en' => $request->doors_en,
                'doors_de' => $request->doors_de,
                'color_en' => $request->color_en,
                'color_de' => $request->color_de,
                'carroserie_en' => $request->carroserie_en,
                'carroserie_de' => $request->carroserie_de,
                'description_en' => $request->description_en,
                'description_de' => $request->description_de,
             ];

             $translation =  BuyCarsTranslation::where('model_id', $car->id)->first();
             $translation = $translation->update($fields);

            if($update > 0){
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }

    }

    public function saveImageCar($type, $car, $image, $fieldName){
        if($type == 'create'){
           if(isset($image)){
                $this->imageService->save($image, $car, 'back/img/cars');
                $car->update([
                    $fieldName => $this->imageService->getFileName($image, $car)
                ]);
           }
        }
        if($type == 'edit'){
            if(isset($image)){
                $path = 'back/img/cars/'.$car[$fieldName];
                $this->imageService->delete($path);
                $this->imageService->save($image, $car, 'back/img/cars');
                $car->update([
                    $fieldName => $this->imageService->getFileName($image, $car)
                ]);
            }
         }
    }

    public function getModelsByMark($mark_id){
        $models = BuyCarsModel::with('translation')
        ->where('buy_cars_marks_id', $mark_id)
        ->get();

        return response()->json([
            "models" => $models
        ]);
    }

    public function getBuyCarsDelete($request){
        $car = BuyCar::where('id', $request->id)
        ->first(); 
        $image_path_1 = 'back/img/cars/'.$car->image_1;
        $image_path_2 = 'back/img/cars/'.$car->image_2;
        $image_path_3 = 'back/img/cars/'.$car->image_3;

        $delete = $car->delete();

        if($delete > 0){
            $this->imageService->delete($image_path_1);
            $this->imageService->delete($image_path_2);
            $this->imageService->delete($image_path_3);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }
}