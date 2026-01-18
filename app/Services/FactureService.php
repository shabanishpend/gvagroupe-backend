<?php

namespace App\Services;
use App\Models\Facture;
use App\Models\User;
use App\Models\Costs;
use App\Models\FactureItem;
use Carbon\Carbon; // Carbon is a popular PHP date manipulation library
use DB;
use App\Mail\FactureMail;
use App\Repositories\FactureRepository;
use Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FactureService{

    protected $factureRepository;

    public function __construct(FactureRepository $factureRepository)
    {
        $this->factureRepository = $factureRepository;
    }

    // Handle the Excel file upload and show preview
    public function getGenerateAndDownload($request)
    {
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $factures = $this->getFacturesRaports($request->excelDateFrom, $request->excelDateTo, 'gvagroupe', $request->excelClient);
        $total_facture_price = $this->getTotalPriceByRange($factures);
        $total_cost_price = $this->getTotalPriceByRangeDepenses($factures);

        // Determine the number of digits needed for Étiquette based on the total factures count
        $factureCount = $factures->count();
        $digitLength = strlen((string) $factureCount);  // Calculate the number of digits in the total factures count

        // Set column headers in the first row
        $sheet->setCellValue('A1', 'N° Étiquette de Caisse');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Catégorie');
        $sheet->setCellValue('D1', 'Description');
        // $sheet->setCellValue('E1', 'Montant (CHF)');
        $sheet->setCellValue('E1', 'Mode de paiement');
        $sheet->setCellValue('F1', 'Observations');
        $sheet->setCellValue('G1', 'Crédit / Entrée');
        $sheet->setCellValue('H1', 'Débit / Sortie');
        $sheet->setCellValue('I1', 'Type');

        // Format header row (Row 1)
        $sheet->getRowDimension(1)->setRowHeight(20);  // Set row height for the header row
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);  // Make the header row bold
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);  // Center align headers
        $sheet->getStyle('A1:I1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);  // Vertical center align headers

        // Set custom column widths
        $sheet->getColumnDimension('A')->setWidth(25);  // Set width for column A
        $sheet->getColumnDimension('B')->setWidth(15);  // Set width for column B
        $sheet->getColumnDimension('C')->setWidth(30);  // Set width for column C
        $sheet->getColumnDimension('D')->setWidth(30);  // Set width for column D
        // $sheet->getColumnDimension('E')->setWidth(15);  // Set width for column E
        $sheet->getColumnDimension('E')->setWidth(25);  // Set width for column F
        $sheet->getColumnDimension('F')->setWidth(25);  // Set width for column G
        $sheet->getColumnDimension('G')->setWidth(25);  // Set width for column G
        $sheet->getColumnDimension('H')->setWidth(25);  // Set width for column G
        $sheet->getColumnDimension('I')->setWidth(25);  // Set width for column G
        // Start adding data from row 2
        $row = 2;

        if (isset($factures)) {
            foreach ($factures as $index => $facture) {
        
                // Generate the Étiquette with leading zeros, based on the total length of factures
                $etiquetteNumber = sprintf('%0' . $digitLength . 'd', $index + 1);  // Adjusts leading zeros dynamically
        
                if ($facture->type_of_facture == 'cost') {
                    $sheet->setCellValue('A' . $row, ''.$etiquetteNumber);
                    $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($facture->payed_date)));
                    $sheet->setCellValue('C' . $row, $facture->categoryAtached->name);
                    $sheet->setCellValue('D' . $row, $facture->description);
                    // $sheet->setCellValue('E' . $row, $facture->total_price);
                    $sheet->setCellValue('E' . $row, $facture->mode_payment);
                    $sheet->setCellValue('F' . $row, $facture->observations);
                    $sheet->setCellValue('G' . $row, '');
                    $sheet->setCellValue('H' . $row, number_format($facture->total_price, 2, '.', "'"));
                    $sheet->setCellValue('I' . $row, 'Dépenses');
        
                    // Align column E (total_price) to the right
                    $sheet->getStyle('H' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                
                if ($facture->type_of_facture == 'facture') {
                    $sheet->setCellValue('A' . $row, ''.$etiquetteNumber);
                    $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($facture->factured_date)));
                    $sheet->setCellValue('C' . $row, 'Facturation client');
                    $sheet->setCellValue('D' . $row, 'Facture ' . $facture->name);
                    // $sheet->setCellValue('E' . $row, $facture->total_ttc);
                    $sheet->setCellValue('E' . $row, 'Virement bancaire');
                    $sheet->setCellValue('F' . $row, $facture->observations);
                    $sheet->setCellValue('G' . $row, number_format($facture->total_ttc, 2, '.', "'"));
                    $sheet->setCellValue('H' . $row, '');
                    $sheet->setCellValue('I' . $row, 'Facture');
                    // Align column E (total_ttc) to the right
                    $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
        
                // Set left alignment for all other columns in the current row
                $sheet->getStyle('A' . $row . ':D' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle('F' . $row . ':G' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle('I' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        
                $row++;
            }
        }    
        
        // Add totals at the end
        $sheet->setCellValue('F' . $row, 'Le total des prix des Crédit / Entrée est:');
        $sheet->setCellValue('G' . $row, number_format($total_facture_price, 2, '.', "'") . ' CHF');
        
        $row++;
        $sheet->setCellValue('F' . $row, 'Le total des prix des Débit / Sortie est:');
        $sheet->setCellValue('H' . $row, number_format($total_cost_price, 2, '.', "'") . ' CHF');


        // Set file name for export
        $fileName = 'rapport.xlsx';

        // Create a writer and save the file to a temporary location
        $writer = new Xlsx($spreadsheet);
        $filePath = storage_path($fileName);
        $writer->save($filePath);

        // Return the file for download and delete it after it's sent
        return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
    }

    public function getFacturesStatuses($website){
        $facturesNotPayed = Facture::whereNull('deleted_at')->where('type_of_facture', 'facture')->where('website', $website)->where('status', 0)->count();
        $facturesPayed = Facture::whereNull('deleted_at')->where('type_of_facture', 'facture')->where('website', $website)->where('status', 1)->count();
        
        $totalFactures = $facturesNotPayed + $facturesPayed;
    
        $percentageNotPayed = $totalFactures > 0 ? (float)($facturesNotPayed / $totalFactures) * 100 : 0;
        $percentagePayed = $totalFactures > 0 ? (float)($facturesPayed / $totalFactures) * 100 : 0;

        return [
            'percentageNotPayed' => round($percentageNotPayed, 2),
            'percentagePayed' => round($percentagePayed, 2),
        ];
    }

    public function getFacturesNotPayes($website){
        $factures = Facture::whereNull('deleted_at')
        ->where('website', $website)
        ->where('type_of_facture', 'facture')
        ->with('client');

        $factures = $factures->where('status', 0)
        ->orderBy('id', 'desc')
        ->get();

        return  $factures;
    }

    public function getFacturesPricesByYear($website) {
        $currentYear = now()->year;
    
        $factures = Facture::whereNull('deleted_at')
            ->where('website', $website)
            ->where('type_of_facture', 'facture')
            ->whereYear('factured_date', $currentYear)
            ->groupBy(DB::raw('MONTH(factured_date)'))
            ->selectRaw('MONTH(factured_date) as month, SUM(total_ttc) as total')
            ->get()
            ->keyBy('month');
    
        $monthlySums = collect([]);
        for ($month = 1; $month <= 12; $month++) {
            $total = $factures->has($month) ? number_format($factures->get($month)->total, 2, '.', '') : '0.00';
            $monthlySums->push([
                'month' => $month,
                'total' => $total ?? '0.00'
            ]);
        }
    
        return $monthlySums;
    }

    public function getRevenueByYear($year, $website){
        return response()->json([
            'revenue' => $this->getRevenue($year, $website)
        ]);
    }
    
    public function getRevenue($year, $website) {
        $today = now();
    
        $thisMonthRevenue = Facture::whereNull('deleted_at')
            ->where('website', $website)
            ->where('type_of_facture', 'facture')
            ->where('status', '!=', 0)
            ->whereMonth('factured_date', $today->month)
            ->whereYear('factured_date', $today->year)
            ->sum('total_ttc');

        if($year != $today->year){
            $thisMonthRevenue = 0;
        }
    
        $previousMonthRevenue = Facture::whereNull('deleted_at')
            ->where('website', $website)
            ->where('type_of_facture', 'facture')
            ->where('status', '!=', 0)
            ->whereMonth('factured_date', $today->subMonth()->month)
            ->whereYear('factured_date', $today->year)
            ->sum('total_ttc');

        if($year != $today->year){
            $previousMonthRevenue = 0;
        }
    
        $allTimeRevenue = Facture::whereNull('deleted_at')
            ->where('website', $website)
            ->where('type_of_facture', 'facture')
            ->where('status', '=', 1)
            ->whereYear('factured_date', $year)
            ->sum('total_ttc');
    
        $totalNotPaid = Facture::whereNull('deleted_at')
            ->where('website', $website)
            ->where('type_of_facture', 'facture')
            ->where('status', '=', 0)
            ->whereYear('factured_date', $year)
            ->sum('total_ttc');
    
        return [
            'this_month' => $thisMonthRevenue,
            'previous_month' => $previousMonthRevenue,
            'all_time' => $allTimeRevenue,
            'totalNotPaid' => $totalNotPaid
        ];
    }

    public function getFacturesRaports($from, $to, $website, $client_id) {
        // Retrieve factures between the specified dates
        $factures = Facture::whereNull('deleted_at')
            ->whereIn('website', ['gvagroupe', 'maflotte'])
            ->where('type_of_facture', 'facture')
            ->with(['items', 'client', 'user', 'car'])
            ->orderBy('factured_date', 'desc');
    
        // Retrieve depenses between the specified dates
        $depenses = Costs::whereNull('deleted_at')
            ->whereIn('website', ['gvagroupe', 'maflotte'])
            ->with(['categoryAtached.subCategory'])
            ->orderBy('payed_date', 'desc');
    
        // Apply date filters to factures
        if (isset($from) && !isset($to)) {
            $factures = $factures->where('factured_date', '>=', $from);
            $depenses = $depenses->where('payed_date', '>=', $from);
        }
    
        if (!isset($from) && isset($to)) {
            $factures = $factures->where('factured_date', '<=', $to);
            $depenses = $depenses->where('payed_date', '<=', $to);
        }
    
        if (isset($from) && isset($to)) {
            $factures = $factures->whereBetween('factured_date', [$from, $to]);
            $depenses = $depenses->whereBetween('payed_date', [$from, $to]);
        }
    
        // Apply client filter to factures if needed
        if (isset($client_id)) {
            $factures = $factures->where('client_id', $client_id);
        }
    
        // Get the results
        $factures = $factures->where('factured_date', '!=', NULL)->get();
        $depenses = $depenses->where('payed_date', '!=', NULL)->get();
    
        // Add 'type' field to factures and depenses
        $factures->map(function ($facture) {
            $facture->type_of_facture = 'facture';  // Set type to 'facture'
            return $facture;
        });
    
        // If client_id is set, skip merging depenses
        if (isset($client_id)) {
            return $factures->values();  // Return only factures, sorted
        }
    
        // Add type to depenses and merge
        $depenses->map(function ($depense) {
            $depense->type_of_facture = 'cost';  // Set type to 'cost'
            return $depense;
        });
    
        // Merge factures and depenses into one collection and sort by date
        $merged = $factures->merge($depenses)->sortByDesc(function ($item) {
            return $item->factured_date ?? $item->payed_date;
        });
        
        return $merged->values();  // Return merged and sorted collection
    }

    public function getTotalPriceByRange($items) {
        // Calculate the total price considering both 'total_ttc' for factures and 'total_price' for costs
        $totalPrice = $items->sum(function ($item) {
            if ($item->type_of_facture === 'facture') {
                return $item->total_ttc;  // Sum the 'total_ttc' for factures
            } elseif ($item->type === 'cost') {
                // return $item->total_price;  // Sum the 'total_price' for costs
            }
            return 0; // If neither, return 0
        });

        // Format the total price to 2 decimal places
        $totalPriceFormatted = number_format($totalPrice, 2, '.', '');
        
        return $totalPriceFormatted;
    }

    public function getTotalPriceByRangeDepenses($items) {
        // Calculate the total price considering both 'total_ttc' for factures and 'total_price' for costs
        $totalPrice = $items->sum(function ($item) {
            if ($item->type === 'facture') {
                // return $item->total_ttc;  // Sum the 'total_ttc' for factures
            } elseif ($item->type_of_facture === 'cost') {
                return $item->total_price;  // Sum the 'total_price' for costs
            }
            return 0; // If neither, return 0
        });

        // Format the total price to 2 decimal places
        $totalPriceFormatted = number_format($totalPrice, 2, '.', '');
        
        return $totalPriceFormatted;
    }

    public function getFieldsFromID($id){
        $facture = $this->getFactureById($id);

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
    
    public function getFactureById($id){
        $facture = Facture::where('id', $id)
        ->with(['items', 'client', 'user'])
        ->first();

        return $facture;
    }

    public function sendFactureToCliend($request){
        $facture = $this->getFactureById($request->id);
        $user = auth()->user();
        $website = $facture->website ?? 'gvagroupe';

        $fields = [
            "email" => $facture->email,
            "id" => $facture->id
        ];

        $data = [];

        if(isset($facture->id)){
            $data = $this->getFieldsFromID($facture->id);
        }

        $data['client'] = $this->getClientFacture($data['client_id']);

        $pdf = PDF::loadView('factures.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4

        // Define the public path
        $publicPath = 'back/pdf/factures/' . $facture->id . '.pdf'; // Saving in the 'public/pdf/factures' directory

        $directory = public_path('back/pdf/factures');
        // Or using plain PHP
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);  // true for recursive creation
        }

        // Save PDF in the public folder
        $pdf->save(public_path($publicPath));

        // Generate email content
        $emailContent = $this->generateEmailContent($facture, $data);
        $subject = 'Facture ' . $facture->name;

        // Create email history record
        $emailHistory = $this->factureRepository->createEmailHistory(
            $facture->id,
            $user->id,
            $facture->client->email,
            $subject,
            $emailContent,
            'pending'
        );

        try {
            
            if($facture->website == 'maflotte'){
                $mail = Mail::mailer('mailer2')->to($facture->client->email);
            }else{
                $mail = Mail::to($facture->client->email);
            }
            $mail = $mail->send(new FactureMail($facture, public_path($publicPath)));

            // Update email history to sent
            $this->factureRepository->updateEmailHistoryToSent($emailHistory->id);

            // Store facture ID before update (update returns boolean)
            $factureId = $facture->id;
            
            $facture->update([
                'email_sended' => 'sended'
            ]);
            
            // You can also log the success or add a response here
            // Check if we came from email history page
            $referer = $request->headers->get('referer');
            if ($referer && strpos($referer, 'email-history') !== false) {
                return redirect()->route('factures.email-history.show', [$factureId, $website])
                    ->with(['success' => 'La facture a été envoyée avec succès par e-mail !']);
            }
            return redirect()->back()->with(['success' => 'La facture a été envoyée avec succès par e-mail !']);
        } catch (\Exception $e) {
            // Update email history to failed
            $this->factureRepository->updateEmailHistoryToFailed($emailHistory->id, $e->getMessage());
            
            // Store facture ID for redirect
            $factureId = $facture->id;
            
            // Log the error or handle it as needed
            // Check if we came from email history page
            $referer = $request->headers->get('referer');
            if ($referer && strpos($referer, 'email-history') !== false) {
                return redirect()->route('factures.email-history.show', [$factureId, $website])
                    ->withInput()->withErrors(["Erreur d'envoi d'emails, s'il vous plaît réessayer plus tard."]);
            }
            return redirect()->back()->withInput()->withErrors(["Erreur d'envoi d'emails, s'il vous plaît réessayer plus tard."]);
        }
    }

    /**
     * Generate email content for history
     */
    private function generateEmailContent($facture, $data)
    {
        $clientName = optional($facture->client)->name ?? '';
        $clientSurname = optional($facture->client)->surname ?? '';
        $factureName = $facture->name ?? '';
        $interventionDate = $data['intervenation_date'] ?? $data['factured_date'] ?? '';
        $formattedDate = $interventionDate ? date('d.m.Y', strtotime($interventionDate)) : '';
        $website = $facture->website ?? 'gvagroupe';
        
        $content = "Bonjour {$clientName} {$clientSurname},\n\n";
        $content .= "J'espère que vous allez bien. Veuillez trouver ci-joint la facture numéro {$factureName} concernant les services fournis en {$formattedDate}. ";
        $content .= "Nous vous prions de bien vouloir procéder au règlement dans les délais spécifiés selon les termes de paiement.\n\n";
        $content .= "N'hésitez pas à nous contacter si vous avez des questions ou si vous avez besoin de renseignements supplémentaires.\n\n";
        $content .= "Nous vous remercions de votre confiance et restons à votre disposition pour toute information complémentaire.\n\n";
        $content .= "Cordialement,\n";
        
        if($website == 'gvagroupe') {
            $content .= "GVGROUPE\n";
            $content .= "contact@gvgroupe.ch\n";
            $content .= "076/265.33.97\n";
        } else {
            $content .= "MAFLOTTE\n";
        }
        
        return $content;
    }

    public function getOffersList(){
        $factures = Facture::orderBy('id', 'desc')
        ->with(['items', 'client', 'user'])
        ->where('type_of_facture', 'offers')
        ->get();
        
        return view('factures.offers.index')
        ->with([
            'factures' => $factures
        ]);
    }

    public function getOffersCreate(){
        return view('factures.offers.create')
        ->with([
            'clients' => $this->getClients('gvagroupe'),
            'type_of_facture' => 'offers',
            'website' => 'gvagroupe'
        ]);
    }

    public function getOffersEdit($id){
        $facture = Facture::where('id', $id)
        ->with(['items', 'client'])
        ->first();

        return view('factures.offers.edit')
        ->with([
            'facture' => $facture,
            'clients' => $this->getClients('gvagroupe'),
            'type_of_facture' => 'offers',
               'website' => 'gvagroupe'
        ]);
    }

    public function getClients($website){
        $users = User::orderBy('id', 'desc')
        ->where('type', 'client')
        ->where('website', $website)
        ->with(['client','cars'])
        ->get();

        return $users;
    }

    public function getUpdatePositions(Request $request, $id){
        info($request->all());
    }

    public function getUpdatePayedDate($request, $id){
        info($request->all());
        $facture = Facture::find($request->facture_id);
        $facture = $facture->update([
            "payable_date" => $request->payable_date
        ]);
    }

    public function getFacturesRaportsPreview($request){
        $factures = $this->getFacturesRaports($request->dateFrom, $request->dateTo, 'gvagroupe', $request->client);
        $data = [
            'factures' => $factures,
            'total_price' => $this->getTotalPriceByRange($factures),
            'total_price_depenses' => $this->getTotalPriceByRangeDepenses($factures),
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'client' => $this->getClientFacture($request->client)
        ];

        $pdf = PDF::loadView('factures.raports.pdf', $data); // Replace 'your.view.file' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->stream($this->facturesRaportsPreviewName(), array('Attachment' => 0)); // Attachment: 0 for inline display
    }

    public function getFacturesRaportsDownload($request){
        $factures = $this->getFacturesRaports($request->dateFrom, $request->dateTo, 'gvagroupe', $request->client);
        $data = [
            'factures' => $factures,
            'total_price' => $this->getTotalPriceByRange($factures),
            'total_price_depenses' => $this->getTotalPriceByRangeDepenses($factures),
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'client' => $this->getClientFacture($request->client)
        ];
        $pdf = PDF::loadView('factures.raports.pdf', $data); // Replace 'factures.pdf' with the path to your view file
        $pdf->setPaper('A4', 'portrait'); // Set pdf to A4
        return $pdf->download($this->facturesRaportsPreviewName()); // Initiates a file download
    }

    public function facturesRaportsPreviewName(){
        // Generate a filename with the current date
        // $today = date('d-m-Y'); // Format: Year-month-day
        $filename = "rapport.pdf";
        return $filename;
    }

    public function getRaportsByWebsite($request, $website){
        $view = 'factures.raports.table';
        return view($view)->with([
            'clientsAll' => $this->getClients($website),
        ]);
    }

    public function getDuplicate($request){
        try {
            $facture = Facture::find($request->id);
            if (!$facture) {
                throw new \Exception('Facture not found');
            }
            $facture->is_archived = true;
            $facture->save();
            $newFacture = $facture->replicate();
            $newFacture->status = Facture::NotPayed;
            $newFacture->is_archived = false;
            $newFacture->email_sended = NULL;
            $newFacture->created_at = now();
            $newFacture->updated_at = now();
            $newFacture->factured_date = now();

            // Adjust subscription dates based on subscription type
            switch ($newFacture->subscription_type) {
                case 'monthly':
                    $newFacture->subscription_start_date = now();
                    $newFacture->subscription_end_date = now()->addMonth();
                    break;
                case '3_months':
                    $newFacture->subscription_start_date = now();
                    $newFacture->subscription_end_date = now()->addMonths(3);
                    break;
                case '6_months':
                    $newFacture->subscription_start_date = now();
                    $newFacture->subscription_end_date = now()->addMonths(6);
                    break;
                case 'yearly':
                    $newFacture->subscription_start_date = now();
                    $newFacture->subscription_end_date = now()->addYear();
                    break;
                default:
                    $newFacture->subscription_start_date = now();
                    $newFacture->subscription_end_date = now();
                    break;
            }

            $newFacture->save();
            $newFacture->name = "REF-" . $newFacture->id;
            $newFacture->save();

            // Duplicate related items if they exist
            if ($facture->items) {
                foreach ($facture->items as $item) {
                    $newItem = $item->replicate();
                    $newItem->facture_id = $newFacture->id;
                    $newItem->save();
                }
            }

            return redirect()->route('factures.edit', [$newFacture->id, $newFacture->website])
                           ->with('success', 'Facture duplicated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error duplicating facture: ' . $e->getMessage());
        }
    }

    public function getUpdatePaymentMethodMode($request, $id){
        $facture = Facture::find($id);
        $facture = $facture->update([
            "payment_method_mode" => $request->payment_method_mode
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment method mode updated successfully'
        ]);
    }

    public function getUpdateShippingMethod($request, $id){
        $facture = Facture::find($id);
        $facture = $facture->update([
            "shipping_method" => $request->shipping_method
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Shipping method updated successfully'
        ]);
    }

    public function getUpdateShippingDate($request, $id){
        $facture = Facture::find($id);
        $facture = $facture->update([
            "shipping_date" => $request->shipping_date
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Shipping date updated successfully'
        ]);
    }

    public function getFacturesGenerated($website){
        $factures = Facture::where('website', $website)->where('status', Facture::Payed)->count();
        return $factures;
    }
    
}