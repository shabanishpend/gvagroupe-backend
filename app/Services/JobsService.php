<?php

namespace App\Services;
use App\Models\JobCategory;
use App\Models\Job;

class JobsService{

    public function getOpenJobs(){
        $openJobs = [];

        try{
            $openJobs = JobCategory::with('jobs')
            ->get();
        }catch(Exception $e){
            $openJobs = [];
        }

        return response()->json([
            "open_jobs" => $openJobs 
        ]);
    }
}