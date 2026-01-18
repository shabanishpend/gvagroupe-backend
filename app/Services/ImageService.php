<?php

namespace App\Services;
use File;
use Illuminate\Support\Str;

class ImageService{

    /**
     * 5:4 Aspect Ratio Dimensions
     * Format: width => height
     */
    private $aspectRatio54 = [
        0 => 0,
        100 => 80,
        200 => 160,
        300 => 240,
        400 => 320,
        500 => 400,
        600 => 480,
        700 => 560,
        800 => 640,
        900 => 720,
        1000 => 800,
        1100 => 880,
        1200 => 960,
        1300 => 1040,
        1400 => 1120,
        1500 => 1200,
        1600 => 1280,
        1700 => 1360,
        1800 => 1440,
        1900 => 1520,
        2000 => 1600,
    ];

    /**
     * Get 5:4 aspect ratio dimensions for a given width
     * 
     * @param int $width
     * @return array ['width' => int, 'height' => int]
     */
    public function getAspectRatio54Dimensions($width = 1000){
        // Find the closest width in the array
        $closestWidth = 0;
        $minDifference = PHP_INT_MAX;
        
        foreach($this->aspectRatio54 as $w => $h){
            $difference = abs($width - $w);
            if($difference < $minDifference){
                $minDifference = $difference;
                $closestWidth = $w;
            }
        }
        
        // If exact match or close enough, return it
        if($minDifference <= 50){
            return [
                'width' => $closestWidth,
                'height' => $this->aspectRatio54[$closestWidth]
            ];
        }
        
        // Otherwise calculate based on 5:4 ratio
        return [
            'width' => $width,
            'height' => (int)($width * 4 / 5)
        ];
    }

    /**
     * Get all 5:4 aspect ratio dimensions
     * 
     * @return array
     */
    public function getAllAspectRatio54Dimensions(){
        return $this->aspectRatio54;
    }

    /**
     * Resize and crop image to 5:4 aspect ratio
     * 
     * @param string $imagePath Full path to the image file
     * @param int $targetWidth Target width (default: 1000)
     * @param string|null $outputFormat Output format (webp, jpeg, png, gif). If null, uses original format
     * @return bool
     */
    public function resizeToAspectRatio54($imagePath, $targetWidth = 1000, $outputFormat = null){
        if(!File::exists($imagePath) || !extension_loaded('gd')){
            return false;
        }

        $imageInfo = getimagesize($imagePath);
        if($imageInfo === false){
            return false;
        }

        $originalWidth = $imageInfo[0];
        $originalHeight = $imageInfo[1];
        $mimeType = $imageInfo['mime'];
        
        $targetDimensions = $this->getAspectRatio54Dimensions($targetWidth);
        $targetWidth = $targetDimensions['width'];
        $targetHeight = $targetDimensions['height'];
        
        $cropData = $this->calculateCropDimensions($originalWidth, $originalHeight, 5/4);
        $sourceImage = $this->loadImage($imagePath, $mimeType);
        
        if($sourceImage === false){
            return false;
        }

        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);
        $this->preserveTransparency($newImage, $mimeType);
        
        imagecopyresampled(
            $newImage, $sourceImage,
            0, 0, $cropData['x'], $cropData['y'],
            $targetWidth, $targetHeight, $cropData['width'], $cropData['height']
        );

        $outputPath = $this->getOutputPath($imagePath, $mimeType, $outputFormat);
        $result = $this->saveImage($newImage, $outputPath, $outputFormat ?: $mimeType);
        
        if($result && $outputPath !== $imagePath){
            File::delete($imagePath);
        }

        imagedestroy($sourceImage);
        imagedestroy($newImage);

        return $result;
    }

    private function calculateCropDimensions($width, $height, $targetRatio){
        $ratio = $width / $height;
        
        if($ratio > $targetRatio){
            $cropWidth = (int)($height * $targetRatio);
            $cropHeight = $height;
            $cropX = (int)(($width - $cropWidth) / 2);
            $cropY = 0;
        } else {
            $cropWidth = $width;
            $cropHeight = (int)($width / $targetRatio);
            $cropX = 0;
            $cropY = (int)(($height - $cropHeight) / 2);
        }

        return ['width' => $cropWidth, 'height' => $cropHeight, 'x' => $cropX, 'y' => $cropY];
    }

    private function loadImage($path, $mimeType){
        return match($mimeType){
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($path),
            'image/png' => imagecreatefrompng($path),
            'image/gif' => imagecreatefromgif($path),
            'image/webp' => imagecreatefromwebp($path),
            default => false
        };
    }

    private function preserveTransparency($image, $mimeType){
        if(in_array($mimeType, ['image/png', 'image/gif'])){
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $transparent = imagecolorallocatealpha($image, 255, 255, 255, 127);
            imagefilledrectangle($image, 0, 0, imagesx($image), imagesy($image), $transparent);
        }
    }

    private function getOutputPath($imagePath, $mimeType, $outputFormat){
        if(!$outputFormat || $outputFormat === $mimeType){
            return $imagePath;
        }

        $extensions = ['image/jpeg' => 'jpg', 'image/jpg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
        $pathInfo = pathinfo($imagePath);
        
        return $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.' . ($extensions[$outputFormat] ?? 'jpg');
    }

    private function saveImage($image, $path, $mimeType){
        return match($mimeType){
            'image/jpeg', 'image/jpg' => imagejpeg($image, $path, 90),
            'image/png' => imagepng($image, $path, 9),
            'image/gif' => imagegif($image, $path),
            'image/webp' => imagewebp($image, $path, 90),
            default => false
        };
    }

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