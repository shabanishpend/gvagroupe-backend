<?php

namespace App\Services;
use File;
use Illuminate\Support\Str;

class ImageService{

    public function save($image, $model, $location){
        $save = $image->move(public_path($location), $this->getFileName($image, $model));

        if($save){
            return true;
        }else{
            return false;
        }
    } 

    public function getFileName($image, $model){
        $file = $image->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        // $uniqueIdentifier = Str::uuid();
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $extension = $extension;
        $filename = $model->id.'-'.$filename.'.'.$extension;
        $filename = str_replace(' ', '_', $filename);

        return $filename;
    }

    public function delete($path){
        if(File::exists($path)) {
            File::delete($path);
        }
    }
}