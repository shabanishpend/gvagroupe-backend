<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorldLeadingBrand;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Project;
use App\Models\BuyCar;
use App;
use Session;

class HomepageController extends Controller
{
    public function index(){
        $world_leading_brands = WorldLeadingBrand::orderBy('created_at', 'desc')
        ->limit(7)
        ->get();
        $testimonials = Testimonial::orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
        $team_members = TeamMember::orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
        $projects = Project::orderBy('created_at', 'desc')
        ->with('translation')
        ->limit(12)
        ->get();
        $cars = BuyCar::where('status', 0)
        ->with(['model', 'mark', 'category'])
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();

        return view('front.homepage.index')
        ->with([
            'world_leading_brands' => $world_leading_brands,
            'testimonials' => $testimonials,
            'team_members' => $team_members,
            'projects' => $projects,
            'cars' => $cars
        ]);
    }

    public function project(){
        return view('front.portfolio.index');
    }

    public function setLocale(Request $request)
    {
        $locale = $request->language;
        session(['locale' => $locale]);
        app()->setLocale($locale);
        return redirect()->back();
    }

    public function privacyPolicy(){
        return view('front.privacy-policy.index');
    }
}
