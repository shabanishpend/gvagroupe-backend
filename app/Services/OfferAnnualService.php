<?php

namespace App\Services;
use App\Models\OfferAnnual;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\FactureService;

class OfferAnnualService{

    public function getOffers($website){
        $offers = OfferAnnual::orderBy('created_at', 'desc')
        ->where('website', $website)
        ->get();

        return $offers;
    }

    public function getOfferById($website, $id){
        $offer = OfferAnnual::orderBy('created_at', 'desc')
        ->where('website', $website)
        ->where('id', $id)
        ->with(['user'])
        ->first();

        return $offer;
    }

    public function getIndex($website){
        return view('maflotte.offers.index')->with([
            'offers'=> $this->getOffers($website)
        ]);
    }

    public function getCreate($website){
        $factureService = app(FactureService::class);
        $clients = $factureService->getClients($website);

        return view('maflotte.offers.create')->with([
            'clients' => $clients
        ]);
    }

    public function getEdit($id){
        return view('maflotte.offers.edit')->with([
            'offre'=> $this->getOfferById('maflotte', $id)
        ]);
    }

    public function getUpdate($request, $website){
        $fields = $request->all();
        $fields['website'] = $website;

        if($fields['type_action'] == 'create'){
            $offer = new OfferAnnual();
            $fields['total_price'] = $this->calculateTotalPrice($fields);
            $create = $offer->create($fields); 
            if($create){
                return redirect()->back()->with(['success' => 'Création réussie !']);
               }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
               }
        }

        if($fields['type_action'] == 'edit'){
            $offer = $this->getOfferById($website, $fields['id']);
            $fields['total_price'] = $this->calculateTotalPrice($fields);
            $update = $offer->update($fields);

            if($update > 0){
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }

        
    }

    public function calculateTotalPrice($fields){
        if(isset($fields['price']) && isset($fields['price_discount'])){
            $total_price = (int)$fields['price_discount'];
            if($fields['type'] == 'year'){
                $total_price = (int)$total_price * 12;
                $total_price = (int)$total_price * (int)$fields['cars_number'];
            }
            if($fields['type'] == '2_year'){
                $total_price = (int)$total_price * 24;
                $total_price = (int)$total_price * (int)$fields['cars_number'];
            }
            if($fields['type'] == '3_year'){
                $total_price = (int)$total_price * 36;
                $total_price = (int)$total_price * (int)$fields['cars_number'];
  
            }
            if($fields['type'] == '4_year'){
                $total_price = (int)$total_price * 48;
                $total_price = (int)$total_price * (int)$fields['cars_number'];
            }
            return $total_price;
        }
        return 0;
    }

    public function calculateDiscountPrice($fields){
        if(isset($fields['price']) && isset($fields['price_discount'])){
            $total_price = (int)$fields['price_discount'];
            return $total_price;
        }
        return 0;
    }

    public function getDestroy($request){
        $offer = $this->getOfferById('maflotte', $request->offre_id);
        $delete = $offer->delete();

        if($delete > 0 ){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getDownload($request){
        $data = $request->all();

        if(isset($data['id'])){
            $data = $this->getOfferById('maflotte',$data['id']);
        }

        $data = $data->toArray();
        $data['discount_price'] = $this->calculateDiscountPrice($data);

        $pdf = PDF::loadView('maflotte.offers.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->download($this->pdfName()); // Initiates a file download
    }

    public function getPreview($request){
        $data = $request->all();

        if(isset($data['id'])){
            $data = $this->getOfferById('maflotte',$data['id']);
        }
        
        $data = $data->toArray();
        $data['discount_price'] = $this->calculateDiscountPrice($data);
  
        $pdf = PDF::loadView('maflotte.offers.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->stream($this->pdfName(), array('Attachment' => 0)); // Attachment: 0 for inline display
    }

    public function pdfName(){
        // Generate a filename with the current date
        $today = date('d-m-Y'); // Format: Year-month-day
        $filename = "offre-{$today}.pdf";
        return $filename;
    }

}