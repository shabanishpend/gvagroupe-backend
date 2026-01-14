<?php

namespace App\Services;
use App\Models\Activity;

class ActivityService{

    public function createActivity($data){
        $fields = [
            "title" => $data["title"],
            "description" => $data["description"],
            "user_id" => (int)$data["user_id"],
            "type" => $data["type"]
        ];
        $activity = new Activity();
        $activity = $activity->create($fields);
    }
}