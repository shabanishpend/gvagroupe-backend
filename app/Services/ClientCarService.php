<?php

namespace App\Services;
use App\Models\ClientCar;
use App\Models\User;

class ClientCarService{

    public function getAllClientsCars(){
        $cars = ClientCar::orderBy('id', 'desc')
        ->with('client')
        ->get();

        return $cars;
    }

    public function getAllClients(){
        $clients = User::orderBy('id', 'desc')
        ->where('type', 'client')
        ->where('website', 'gvagroupe')
        ->get();

        return $clients;
    }
    public function getIndex(){
        return view('clients.cars.index')->with([
            'cars' => $this->getAllClientsCars()
        ]);
    }

    public function getCreate(){
        return view('clients.cars.create')->with([
            'clients' => $this->getAllClients()
        ]);
    }

    public function getEdit($id){
        $car = ClientCar::where('id', $id)->first();
        return view('clients.cars.edit')->with([
            'car' => $car,
            'clients' => $this->getAllClients()
        ]);
    }

    public function getUpdate($request){
        $fields = [
            'nr_plaques' => $request->nr_plaques,
            'km_voiture'  => $request->km_voiture,
            'pu_kw'  => $request->pu_kw,
            'annee'  => $request->annee,
            'marque'  => $request->marque,
            'type'  => $request->type,
            'chassis'  => $request->chassis,
            'hml'  => $request->hml,
            'client_id'  => $request->client_id,
        ];

        $request->validate([
            'client_id' => 'required',
        ]);

        if($request->type_form == 'create'){
            $clientCar = new ClientCar();
            $clientCar = $clientCar->create($fields);

            if($clientCar){
                return redirect()->back()->with(['success' => 'Création réussie !']);   
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }
        
        if($request->type_form == 'edit'){
            $clientCar = ClientCar::where('id', $request->id)->first();
            $update = $clientCar->update($fields);

            if($update > 0){
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }


    }

    public function getDestroy($request){
        $clientCar = ClientCar::find($request->client_id);
        $delete = $clientCar->delete();
        if($delete > 0){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getCarsByClient($client_id){
        $cars = ClientCar::where('client_id', $client_id)
        ->get();

        return response()->json([
            'cars' => $cars
        ]);
    }
}