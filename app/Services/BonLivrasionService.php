<?php

namespace App\Services;
use App\Services\FactureService;
use App\Models\BonLivraison;
use App\Models\BonLivrasionItem;
use Barryvdh\DomPDF\Facade\Pdf;

class BonLivrasionService{

    public function getLivrasions($website){
        $bon_livrasions = BonLivraison::orderBy('created_at', 'desc')
        ->where('website', $website)
        ->with(['items', 'client'])
        ->get();

        return $bon_livrasions;
    }

    public function getLivrasionById($website, $id){
        $bon_livrasion = BonLivraison::orderBy('created_at', 'desc')
        ->where('website', $website)
        ->where('id', $id)
        ->with(['items', 'client'])
        ->first();

        return $bon_livrasion;
    }

    public function getIndex($website){
        return view('bon_livrasion.index')
        ->with([
            'bon_livrasions' => $this->getLivrasions($website)
        ]);
    }

    public function getCreate($website){
        $factureService = app(FactureService::class);
        $clients = $factureService->getClients($website);

        return view('bon_livrasion.create')->with([
            'clients' => $clients
        ]);
    }

    public function getEdit($id){
        $factureService = app(FactureService::class);
        $clients = $factureService->getClients('maflotte');

        return view('bon_livrasion.edit')->with([
            'clients' => $clients,
            'bon_livrasion' => $this->getLivrasionById('maflotte', $id)
        ]);
    }

    public function getUpdate($request, $website){
        $fields = $request->all();

        $fieldsLivrasion = [
            'date' => $fields['date'],
            'article' => $fields['article'],
            'website' => $website,
            'article_description' => $fields['article_description'],
            'client_id' => $fields['client_id']
        ];

        if($fields['type_form'] == 'create'){
            $bon_livrasion = new BonLivraison();
            $bon_livrasion = $bon_livrasion->create($fieldsLivrasion);
            $this->createOrUpdateItems($bon_livrasion, $fields);

            if($bon_livrasion){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($fields['type_form'] == 'edit'){
            $bon_livrasion = BonLivraison::where('id', $fields['id'])->first();
            $update = $bon_livrasion->update($fieldsLivrasion);
            $this->createOrUpdateItems($bon_livrasion, $fields);
            
            if($update > 0){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

 
    }

    public function createOrUpdateItems($model, $fields){
        if(isset($fields['items'])){
            $items = $fields['items'];
            // dd($items);
            if($fields['type_form'] == 'create'){
                foreach($items as $item){
                    $fieldsItem = [
                     'title' => $item['title'],
                     'imei' => $item['imei'],
                     'nr_cart_sim' => $item['nr_cart_sim'],
                     'bon_livraison_id' => $model->id
                    ];
     
                    $newItem = new BonLivrasionItem();
                    $newItem = $newItem->create($fieldsItem);
                }
            }
            if($fields['type_form'] == 'edit'){
                $delete = BonLivrasionItem::where('bon_livraison_id', $model->id)->delete();
                foreach($items as $item){
                    $fieldsItem = [
                     'title' => $item['title'],
                     'imei' => $item['imei'],
                     'nr_cart_sim' => $item['nr_cart_sim'],
                     'bon_livraison_id' => $model->id
                    ];
     
                    $newItem = new BonLivrasionItem();
                    $newItem = $newItem->create($fieldsItem);
                }
            }
        }
    }

    public function getDestroy($request){
        $bon_livrasion = BonLivraison::find($request->delete_id);
        $status = $bon_livrasion->delete();

        if($status > 0 ){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getPreview($request){
        $data = $request->all();

        if(isset($data['id'])){
            $data = $this->getLivrasionById('maflotte', $data['id']);
        }
        
        $data = $data->toArray();
        $pdf = PDF::loadView('bon_livrasion.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->stream($this->pdfName(), array('Attachment' => 0)); // Attachment: 0 for inline display
    }

    public function getDownload($request){
        $data = $request->all();

        if(isset($data['id'])){
            $data = $this->getLivrasionById('maflotte', $data['id']);
        }

        $data = $data->toArray();
        $pdf = PDF::loadView('bon_livrasion.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->download($this->pdfName()); // Initiates a file download
    }

    public function pdfName(){
        // Generate a filename with the current date
        $today = date('d-m-Y'); // Format: Year-month-day
        $filename = "bon-livrasion-{$today}.pdf";
        return $filename;
    }
}