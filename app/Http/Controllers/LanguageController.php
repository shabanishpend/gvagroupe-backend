<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ActivityService;
use App\Services\LanguageService;

class LanguageController extends Controller
{
    private $userService;
    private $activityService;
    private $languageService;

    public function __construct(UserService $userService, ActivityService $activityService, LanguageService $languageService)
    {
        $this->userService = $userService;
        $this->activityService = $activityService;
        $this->languageService = $languageService;
    }
}
