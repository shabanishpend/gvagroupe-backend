<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Models\Job;
use App\Services\JobsService;

class JobController extends Controller
{

    private $jobsService;
    private $activityService;

    public function __construct(JobsService $jobsService)
    {
        $this->jobsService = $jobsService;
    }

    public function jobs(){
        return $this->jobsService->getOpenJobs();
    }
}