<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Facture;
use App\Models\User;
use App\Models\FactureItem;
use App\Services\FactureService;

class FactureController extends Controller
{

    private $factureService;

    public function __construct(FactureService $factureService)
    {
        $this->factureService = $factureService;
    }
    
    public function index($website){
        $factures = Facture::orderBy('factured_date', 'desc')
        ->with(['items', 'client', 'user', 'car'])
        ->where('type_of_facture', 'facture');
        
        if(isset($website)){
            $factures = $factures->where('website', $website);
        }

        $factures = $factures->get()->map(function($facture) {
            $todayDate = \Carbon\Carbon::now();
            $options = ["monthly", "3_months", "6_months", "yearly"];
            $is_expired = false;
            $warning = false;
            $row_color = '';

            $subscription_type = $facture->subscription_type;
            $payable_end_time = $facture->subscription_start_date;
            $subscription_end_date = $facture->subscription_end_date;

            if(in_array($subscription_type, $options)){
                $end_date = strtotime($payable_end_time);
                
                switch($subscription_type) {
                    case 'monthly':
                        $end_date = strtotime("+1 month", $end_date);
                        $warning_date = strtotime("-15 days", $end_date);
                        break;
                    case '3_months':
                        $end_date = strtotime("+3 months", $end_date);
                        $warning_date = strtotime("-1 month", $end_date);
                        break;
                    case '6_months':
                        $end_date = strtotime("+6 months", $end_date);
                        $warning_date = strtotime("-1 month", $end_date);
                        break;
                    case 'yearly':
                        $end_date = strtotime("+1 year", $end_date);
                        $warning_date = strtotime("-1 month", $end_date);
                        break;
                }

                if($todayDate->greaterThan(\Carbon\Carbon::createFromTimestamp($end_date))){
                    $is_expired = true;
                    $row_color = 'red';
                } elseif($todayDate->greaterThan(\Carbon\Carbon::createFromTimestamp($warning_date))) {
                    $warning = true;
                    $row_color = 'orange';
                }

            } else if(isset($subscription_end_date)) {
                if($todayDate->greaterThan(\Carbon\Carbon::parse($subscription_end_date))){
                    $is_expired = true;
                    $row_color = 'red';
                }
            }

            $facture->is_expired = $is_expired;
            $facture->warning = $warning;
            $facture->row_color = $row_color;
            return $facture;
        });
        
        return view('factures.index')
        ->with([
            'factures' => $factures,
            'website' => $website
        ]);
    }

    public function getClients($website){
        $users = User::orderBy('id', 'desc')
        ->where('type', 'client')
        ->where('website', $website)
        ->with('client')
        ->get();

        return $users;
    }

    public function create($website){
        return view('factures.create')
        ->with([
            'clients' => $this->factureService->getClients($website),
            'type_of_facture' => 'facture',
            'website' => $website
        ]);
    }

    public function edit($id, $website){
        $facture = Facture::where('id', $id)
        ->with(['items', 'client', 'car'])
        ->first();

        return view('factures.edit')
        ->with([
            'facture' => $facture,
            'clients' => $this->factureService->getClients($website),
            'type_of_facture' => 'facture',
            'website' => $website
        ]);
    }

    public function update(Request $request){
        $fields = [];

        if(!isset($request->status_change_only) && $request->status_change_only != 'true'){
            $fields = [
                'factured_city' => $request->factured_city,
                'factured_date' => $request->factured_date,
                'nr_plaque' => $request->plaque,
                'km_voiture' => $request->km_voiture,
                'pu_kw' => $request->pu_km,
                'annee' => $request->year,
                'marque' => $request->marque,
                'type' => $request->type,
                'chassis' => $request->chassis,
                'hml' => $request->hml,
                'intervenation_date' => $request->intervenation_date,
                'tvsh' => $request->tvsh,
                'total_tva' => $request->total_tva,
                'total_ttc' => $request->total_ttc,
                'total_hors_quantity' => $request->total_hors_quantity,
                'total_hors_tva' => $request->total_hors_tva,
                'total_hors_price' => $request->total_hors_price,
                'client_id' => $request->client_id,
                'cordialement' => $request->cordialement,
                'user_id' => auth()->user()->id,
                'client_car_id' => $request->car,
                'website' => $request->website,
                'hide_car_details' => $request->hide_car_details,
                'payable_end_time' => $request->payable_end_time,
                'payment_method_mode' => $request->payment_method_mode,
                'subscription_type' => $request->subscription_type,
                'subscription_start_date' => $request->subscription_start_date,
                'subscription_end_date' => $request->subscription_end_date
            ];

            if(isset($request->type_of_facture)){
                $fields['type_of_facture'] = $request->type_of_facture;
            }

            if($request->type_form == 'create'){
                $fields['status'] = 0;
            }
        }else{
            $fields['status'] = $request->status;
            if($fields['status'] == 1){
                $fields['payable_date'] = now();
            }else{
                $fields['payable_date'] = $request->payable_date;
            }
        }
        
        if($request->type_form == 'create'){
            $facture = new Facture();
            $facture = $facture->create($fields);

            if($facture){
                $this->addItems($request->items, $facture);
                $this->generateFactureName($facture);
                $route = 'factures';
                if($request->type_of_facture == 'offers'){
                    $route = 'offers';
                } 
                return redirect()->route($route, ['website' => $request->website])->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type_form == 'edit'){
            $facture = $this->getFactureWithID($request->id);
            $fields['payable_date'] = $facture->payable_date;
            
            if(!isset($request->status_change_only) && $request->status_change_only != true){
                // dd($request->items);
                $this->deleteItems($request->items, $facture);
                $this->generateFactureName($facture);
            }
            $update = $facture->update($fields);
            if($update > 0){
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }
    }

    public function generateFactureName($model){
        $name = 'RE-'.$model->id;
        $model->update([
            'name' => $name,
        ]);
    }

    public function deleteItems($items, $model){
        $deleteAllItems = FactureItem::where('facture_id', $model->id)->forceDelete();
        // dd($items);
        if(isset($items) && count($items) > 0){
            foreach($items as $item){
                $fields = [];
                if(isset($item['title'])){
                    $fields['title'] = $item['title'];
                }
                if(isset($item['prix_unitaire'])){
                    $fields['prix_unitaire'] = $item['prix_unitaire'];
                }
                if(isset($item['quantity'])){
                    $fields['quantity'] = $item['quantity'];
                }
                if(isset($item['total_chf'])){
                    $fields['total_chf'] = $item['total_chf'];
                }
                if(isset($model->id)){
                    $fields['facture_id'] =  $model->id;
                }
                $item = new FactureItem();
                $item = $item->create($fields);
            }
        }
    }

    public function addItems($items, $model){
        if(isset($items) && count($items) > 0){
            foreach($items as $item){
                $title_encoded = htmlentities($item['title'], ENT_QUOTES, 'UTF-8');
                $fields = [
                    'title' => $title_encoded,
                    'prix_unitaire' => $item['prix_unitaire'],
                    'quantity' => $item['quantity'],
                    'total_chf' => $item['total_chf'],
                    'facture_id' => $model->id
                ];
                $item = new FactureItem();
                $item = $item->create($fields);
            }
        }
    }

    public function getFactureWithID($id){
        $facture = Facture::where('id', $id)
        ->with('items')
        ->first();

        return $facture;
    }

    public function getFieldsFromID($id){
        $facture = Facture::where('id', $id)
        ->with(['items', 'client'])
        ->first();

        $data = [
            'id' => $facture->id,
            'plaque' => $facture->nr_plaque,
            'km_voiture' => $facture->km_voiture,
            'pu_km' => $facture->pu_kw,
            'year' => $facture->annee,
            'marque' => $facture->marque,
            'type' => $facture->type,
            'chassis' => $facture->chassis,
            'hml' => $facture->hml,
            'intervenation_date' => $facture->intervenation_date,
            'tvsh' => $facture->tvsh,
            'total_tva' => $facture->total_tva,
            'total_ttc' => $facture->total_ttc,
            'total_hors_quantity' => $facture->total_hors_quantity,
            'total_hors_tva' => $facture->total_hors_tva,
            'total_hors_price' => $facture->total_hors_price,
            'items' => $facture->items,
            'client' => $facture->client,
            'factured_date' => $facture->factured_date,
            'factured_city' => $facture->factured_city,
            'name' => $facture->name,
            'client_id' => $facture->client_id,
            'cordialement' => $facture->cordialement,
            'user_id' => $facture->user_id,
            'type_of_facture' => $facture->type_of_facture,
            'website' => $facture->website,
            'hide_car_details' => $facture->hide_car_details,
            'payable_end_time' => $facture->payable_end_time,
            'subscription_type' => $facture->subscription_type,
            'subscription_start_date' => $facture->subscription_start_date,
            'subscription_end_date' => $facture->subscription_end_date,
            'is_archived' => $facture->is_archived
        ];

        return $data;
    }

    public function getClientFacture($id){
        $client = null;
        if(isset($id)){
            $client = User::where('type', 'client')
            ->where('id', $id)
            ->first();
        }

        return $client;
    }

    public function preview(Request $request){
        $data = $request->all();

        if(isset($data['id'])){
            $data = $this->getFieldsFromID($data['id']);
        }
        
        $data['client'] = $this->getClientFacture($data['client_id']);
        $data['totalPages'] = 1;

        $pdf = PDF::loadView('factures.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->stream($this->pdfName(), array('Attachment' => 0)); // Attachment: 0 for inline display
    }

    public function download(Request $request){
        $data = $request->all();
        if(isset($data['id'])){
            $data = $this->getFieldsFromID($data['id']);
        }
        $pdf = PDF::loadView('factures.pdf', $data); // Replace 'factures.pdf' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->download($this->pdfName()); // Initiates a file download
    }

    public function pdfName(){
        // Generate a filename with the current date
        $today = date('d-m-Y'); // Format: Year-month-day
        $filename = "facture-{$today}.pdf";
        return $filename;
    }

    public function print(Request $request){
        $data = $request->all();
        if(isset($data['id'])){
            $data = $this->getFieldsFromID($data['id']);
        }
        // $data['tvsh'] = $data['tvsh'] ?? 0;
        $data['client'] = $this->getClientFacture($data['client_id']);
        return view('factures.pdf-print')->with([
            'data' => $data
        ]);
    }

    public function delete(Request $request){
        $data = $request->all();
        if(isset($data['id'])){
            $delete = Facture::where('id', $data['id'])->delete();
            if($delete > 0){
               return redirect()->back()->with(['success' => 'Suppression réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
            }
        }
    }

    public function emailSend(Request $request){
        return $this->factureService->sendFactureToCliend($request);
    }

    public function offersList(){
        return $this->factureService->getOffersList();
    }   

    public function offersCreate(){
        return $this->factureService->getOffersCreate();
    }  

    public function offersEdit($id){
        return $this->factureService->getOffersEdit($id);
    } 

    public function updatePositions($id){
        return $this->factureService->getUpdatePositions($id);
    }

    public function updatePayedDate(Request $request, $id){
        return $this->factureService->getUpdatePayedDate($request, $id);
    }

    public function facturesRaportsByWebsite(Request $request, $website){
        return $this->factureService->getRaportsByWebsite($request, $website);
    }

    public function revenueByYear($year, $website){
        return $this->factureService->getRevenueByYear($year, $website);
    }

    public function generateAndDownload(Request $request){
        return $this->factureService->getGenerateAndDownload($request);
    }

    public function duplicate(Request $request){
        return $this->factureService->getDuplicate($request);
    }

    public function updatePaymentMethodMode(Request $request, $id){
        return $this->factureService->getUpdatePaymentMethodMode($request, $id);
    }

    public function updateShippingMethod(Request $request, $id){
        return $this->factureService->getUpdateShippingMethod($request, $id);
    }


    public function updateShippingDate(Request $request, $id){
        return $this->factureService->getUpdateShippingDate($request, $id);
    }
}
