<?php

namespace App\Services;
use App\Models\AutoRental;
use App\Models\AutoRentalTranslation;
use App\Services\ImageService;
use Carbon\Carbon;

class AutoRentalService{

    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getIndex(){
        $rentals = AutoRental::with('translation')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('auto-rental.index')->with([
            'rentals' => $rentals
        ]);
    }

    public function getCreate($request){
        return view('auto-rental.create');
    }

    public function getEdit($id){
        $rental =  AutoRental::where('id', $id)->first();
        return view('auto-rental.edit')->with(['rental' => $rental]);
    }

    public function getUpdate($request){

        $fields = [
            "name" => $request->name,
            "price" => $request->price,
            "fuel" => $request->fuel,
            "year" => $request->year,
            "transmission" => $request->transmission,
            "seats" => $request->seats,
            "doors" => $request->doors,
            'location' => $request->location,
            "performance" => $request->performance,
            "description" => $request->description,
            "date_from" => $request->date_from,
            "time_from" => $request->time_from,
            "date_to" => $request->date_to,
            "time_to" => $request->time_to,
        ];

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'location' => 'required',
        ]);

        if($request->type == 'create'){
            $request->validate([
                'image_1' => 'required',
            ]);
            $fields['status'] = 0;
            $rental = new AutoRental();
            $rental = $rental->create($fields);
            if($rental){
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
                    'description_en' => $request->description_en,
                    'description_de' => $request->description_de,
                    'model_id' => $rental->id
                ];

                $translation = new AutoRentalTranslation();
                $translation = $translation->create($fields);

                if(isset($request->image_1)){
                    $this->imageService->save($request->image_1, $rental, 'back/img/auto-rental');
                    $rental->update([
                        'image_1' => $this->imageService->getFileName($request->image_1, $rental)
                    ]);
                }
                if(isset($request->image_2)){
                    $this->imageService->save($request->image_2, $rental, 'back/img/auto-rental');
                    $rental->update([
                        'image_2' => $this->imageService->getFileName($request->image_2, $rental)
                    ]);
                }
                if(isset($request->image_3)){
                    $this->imageService->save($request->image_3, $rental, 'back/img/auto-rental');
                    $rental->update([
                        'image_3' => $this->imageService->getFileName($request->image_3, $rental)
                    ]);
                }
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $rental = AutoRental::where('id', $request->id)->first();
            $fields['status'] = $request->status;
            $edit = $rental->update($fields);
            if($edit > 0){
                if(isset($request->image_1)){
                    $path = 'back/img/auto-rental/'.$rental->image_1;
                    $this->imageService->delete($path);
                    $this->imageService->save($request->image_1, $rental, 'back/img/auto-rental');
                    $rental->update([
                        'image_1' => $this->imageService->getFileName($request->image_1, $rental)
                    ]);
                }
                if(isset($request->image_2)){
                    $path = 'back/img/auto-rental/'.$rental->image_2;
                    $this->imageService->delete($path);
                    $this->imageService->save($request->image_2, $rental, 'back/img/auto-rental');
                    $rental->update([
                        'image_2' => $this->imageService->getFileName($request->image_2, $rental)
                    ]);
                }
                if(isset($request->image_3)){
                    $path = 'back/img/auto-rental/'.$rental->image_3;
                    $this->imageService->delete($path);
                    $this->imageService->save($request->image_3, $rental, 'back/img/auto-rental');
                    $rental->update([
                        'image_3' => $this->imageService->getFileName($request->image_3, $rental)
                    ]);
                }

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
                    'description_en' => $request->description_en,
                    'description_de' => $request->description_de,
                 ];
    
                 $translation =  AutoRentalTranslation::where('model_id', $rental->id)->first();
                 $translation = $translation->update($fields);

                 
                return redirect()->back()->with(['success' => 'Édité avec succès !']);
            }else{
                return redirect()->back()->withInput()->withErrors(["Erreur lors de l'édition !"]);
            }
        }
    }

    public function getDelete($request){
        $rental = AutoRental::where('id', $request->id)
        ->first(); 

        $image_path_1 = 'back/img/auto-rental/'.$rental->image_1;
        $image_path_2 = 'back/img/auto-rental/'.$rental->image_2;
        $image_path_3 = 'back/img/auto-rental/'.$rental->image_3;

        $delete = $rental->delete();

        if($delete > 0){
            $this->imageService->delete($image_path_1);
            $this->imageService->delete($image_path_2);
            $this->imageService->delete($image_path_3);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getSearch($request){
        $dateFrom = $request->rental_from;
        $timeFrom = $request->rental_time_from;
        $dateTo = $request->rental_to;
        $timeTo = $request->rental_time_to;

        // Combine date and time values into DateTime objects
        $startDateTime = Carbon::parse($dateFrom . ' ' . $timeFrom);
        $endDateTime = Carbon::parse($dateTo . ' ' . $timeTo);
        
        $rental = AutoRental::orderBy('created_at', 'desc')
        ->with('translation')
        ->where('status', 0);

        if(isset($request->location)){
            // $rental = $rental->where('location', $request->location);
        }

        $rental = $rental->get();

        return view('front.auto-rental.search')->with([
            'cars' => $rental
        ]);


    }

    public function getCar($id){
        $rental =  AutoRental::where('id', $id)->first();
        return view('front.auto-rental.car')->with(['car' => $rental]);
    }
    
}