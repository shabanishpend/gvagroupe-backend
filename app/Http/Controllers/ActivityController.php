<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Services\UserService;

class ActivityController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->userService->abortMiddlewareIfIsManagement($this);
    }

    public function index(){
        $activities = Activity::orderBy('created_at', 'desc')
        ->get();

        return view('activities.index')->with([
            "activities" => $activities
        ]);
    }
}
