<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\BuyCar;
use App\Services\BuyCarsService;
use App\Models\BuyCarsCategory;
use App\Models\BuyCarsModel;

class CarsController extends Controller
{
    private $buyCarsService;

    public function __construct(BuyCarsService $buyCarsService)
    {
        $this->buyCarsService = $buyCarsService;
    }

    public function index(Request $request){
        $cars = BuyCar::with(['translation', 'category.translation', 'mark.translation', 'model.translation'])
        ->where('status', 0);

        if(isset($request->category)){
            $cars = $cars->where('buy_cars_category', $request->category);
        }

        if(isset($request->mark)){
            $cars = $cars->where('buy_cars_marks_id', $request->mark);
        }
        
        if(isset($request->model)){
            $cars = $cars->where('buy_cars_models_id', $request->model);
        }

        if(isset($request->price)){
            $cars = $cars->whereRaw("REPLACE(price, '.', '') <= ?", [str_replace('.', '', $request->price)])
            ->orderBy('price', 'desc');
        }else{
            $cars = $cars->orderBy('created_at', 'desc');
        }

        $cars = $cars->get();

        return view('front.cars.all')
        ->with([
            'cars' => $cars,
            'categories' => $this->buyCarsService->getBuyCarCategories(),
            'marks' => $this->buyCarsService->getBuyCarMarks()
        ]);
    }

    public function filter(Request $request){
        $cars = BuyCar::with(['translation', 'category.translation', 'mark.translation', 'model.translation'])
        ->where('status', 0);

        if(isset($request->categories) && count($request->categories) > 0){
            $categories = [];
            foreach($request->categories as $category){
                array_push($categories, $category);
            }
            $cars = $cars->whereIn('buy_cars_category', $categories);
        }

        if(isset($request->marks) && count($request->marks) > 0){
            $marks = [];
            foreach($request->marks as $mark){
                array_push($marks, $mark);
            }
            $cars = $cars->whereIn('buy_cars_marks_id', $marks);
        }

        if(isset($request->seats) && count($request->seats) > 0){
            $seats = [];
            foreach($request->seats as $seat){
                array_push($seats, $seat);
            }
            $cars = $cars->whereIn('seats', $seats);
        }
        

        $cars = $cars
        ->where('price', '>=', $request->minPrice)
        ->where('price', '<=', $request->maxPrice)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'cars' => $cars,
        ]);
    }

    public function car($id){
        $car = BuyCar::where('id', $id)
        ->with(['translation','mark.translation', 'model.translation', 'category.translation'])
        ->where('status', 0)
        ->first();

        return view('front.cars.car')
        ->with([
            'car' => $car
        ]);
    }
}
