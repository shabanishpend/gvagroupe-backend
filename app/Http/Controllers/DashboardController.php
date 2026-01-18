<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeamMember;
use App\Models\Project;
use App\Models\Blog;
use App\Models\Activity;
use App\Services\UserService;
use App\Services\FactureService;
use App\Services\CostService;
use App\Models\Facture;
class DashboardController extends Controller
{
    private $userService;
    private $factureService;
    private $costService;

    public function __construct(UserService $userService, FactureService $factureService, CostService $costService)
    {
        $this->userService = $userService;
        $this->factureService = $factureService;
        $this->costService = $costService;
    }
    
    public function index(Request $request, $website = 'gvagroupe')
    {
        if($this->userService->isDepensesManagment()){
            return redirect()->route('costs');
        }

        if (is_null($website)) {
            $website = 'gvagroupe';
        }

        if($website == 'maflotte'){
            $website = 'maflotte';
        }

        // Fetch data for both views
        $users_count = User::where('type', 'user')->where('website', $website)->count();
        $team_members_count = TeamMember::count();
        $projects_count = Project::count();
        $blogs_count = Blog::count();
        $activities = Activity::orderBy('created_at', 'desc')->limit(20)->get();
        $clients = User::where('type', 'client')->where('website', $website)->count();
        $view = 'dashboard';

        if($website == 'maflotte'){
            $view = $website;
        }

        $year = date('Y');
        $month = date('m');

        // Calculate monthly change indicators
        $users_count_last_month = User::where('type', 'user')->where('website', $website)->whereMonth('created_at', $month - 1)->count();
        $team_members_count_last_month = TeamMember::whereMonth('created_at', $month - 1)->count();
        $projects_count_last_month = Project::whereMonth('created_at', $month - 1)->count();
        $blogs_count_last_month = Blog::whereMonth('created_at', $month - 1)->count();
        $factures_generated_last_month = Facture::whereMonth('created_at', $month - 1)->where('status', Facture::Payed)->count();
        $clients_last_month = User::where('type', 'client')->where('website', $website)->whereMonth('created_at', $month - 1)->count();
        $factures_generated = Facture::where('website', $website)->where('status', Facture::Payed)->count();
        
        $users_trend = $users_count > $users_count_last_month ? 'up' : 'down';
        $clients_trend = $clients > $clients_last_month ? 'up' : 'down';
        $team_members_trend = $team_members_count > $team_members_count_last_month ? 'up' : 'down';
        $projects_trend = $projects_count > $projects_count_last_month ? 'up' : 'down';
        $blogs_trend = $blogs_count > $blogs_count_last_month ? 'up' : 'down';
        $factures_generated_trend = $factures_generated > $factures_generated_last_month ? 'up' : 'down';
        $requestFields = $request->all();
        $requestFields['website'] = $website;
        
        return view($view)->with([
            'users_count' => $users_count,
            'users_trend' => $users_trend,
            'team_members_count' => $team_members_count,
            'team_members_trend' => $team_members_trend,
            'projects_count' => $projects_count,
            'projects_trend' => $projects_trend,
            'blogs_count' => $blogs_count,
            'blogs_trend' => $blogs_trend,
            'activities' => $activities,
            'clients' => $clients,
            'clients_trend' => $clients_trend,
            'factures_status' => $this->factureService->getFacturesStatuses($website),
            'factures_not_payed' => $this->factureService->getFacturesNotPayes($website),
            "factures_by_months" => $this->factureService->getFacturesPricesByYear($website),
            'monthlyCosts' => $this->costService->getCostsByMonths($year),
            'totalCostsByYear'=> $this->costService->getAllCostByYear($year),
            'clientsAll' => $this->factureService->getClients($website),
            'factures_generated' => $this->factureService->getFacturesGenerated($website),
            'factures_generated_trend' => $factures_generated_trend,
            'costs_by_months' => $this->costService->getCostsPricesByYear($website),
        ]);
    }

    public function facturesRaports(Request $request){
        $fields = $request->all();
        $factures = $this->factureService->getFacturesRaports($fields['dateFrom'], $fields['dateTo'], 'gvagroupe', $request->client);
        $total_price = $this->factureService->getTotalPriceByRange($factures);
        $total_price_depenses = $this->factureService->getTotalPriceByRangeDepenses($factures);
        
        return response()->json([
            "factures" => $factures,
            "total_price" => $total_price,
            "total_price_depenses" => $total_price_depenses
        ]);
    }

    public function facturesRaportsPreview(Request $request){
        return $this->factureService->getFacturesRaportsPreview($request);
    }

    public function facturesRaportsDownload(Request $request){
        return $this->factureService->getFacturesRaportsDownload($request);
    }

}
