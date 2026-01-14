<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivityService;
use App\Models\Testimonial;
use Auth;
use File;

class TestimonialController extends Controller
{
    private $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function getTestimonials(){
        $testimonials = Testimonial::orderBy('created_at','desc')
        ->limit(3)
        ->get();

        return $testimonials;
    }

    public function getOneTestimonial($id){
        $testimonial = Testimonial::where('id', $id)->first();
        
        return $testimonial;
    }

    public function testimonials(){
        return response()->json([
            "testimonials" => $this->getTestimonials()
        ]);
    }

    public function index(){
        return view('testimonials.index')
        ->with([
            "testimonials" => $this->getTestimonials()
        ]);
    }

    public function create(){
        return view('testimonials.create');
    }

    public function edit($id){
        return view('testimonials.edit')
        ->with([
            'testimonial' => $this->getOneTestimonial($id)
        ]);
    }

    public function update(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'position' => 'required',
            'full_name' => 'required',
        ]);

        $fields = [
            'title' => $request->title,
            'description' => $request->description,
            'user_full_name' => $request->full_name,
            'user_position' => $request->position
        ];

        if($request->type == 'create'){
            $request->validate([
                'image' => 'required|max:200000',
            ]);

            $testimonial = new Testimonial();
            $testimonial = $testimonial->create($fields);

            if($testimonial){
                $this->saveOrUpdateImage($request->image, $testimonial, $request->type);
                $data = [
                    "title" => 'Created Testimonial: '.$testimonial->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a créé un témoignage !',
                    "user_id" => Auth::user()->id,
                    'type' => 'testimonial_create'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }

        }

        if($request->type == 'edit'){
            $testimonial = Testimonial::where('id', $request->testimonial_id)->first();
            $update = $testimonial->update($fields);

            if($update > 0){
                $this->saveOrUpdateImage($request->image, $testimonial, $request->type);
                $data = [
                    "title" => 'Updated Testimonial: '.$testimonial->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour ce témoignage !',
                    "user_id" => Auth::user()->id,
                    'type' => 'testimonial_update'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }

        }

    }

    public function saveOrUpdateImage($image, $testimonial, $type){
        if(isset($image)){
            $file = $image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $imageName = $testimonial->id.'-'.$filename.'.webp'; 
            
            if($type == 'edit'){
                if($testimonial->user_image != $imageName){
                    $image_path = 'back/img/testimonials/'.$imageName;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
            }

            $image->move(public_path('back/img/testimonials'), $imageName);

            $testimonial = $testimonial->update([
                "user_image" => $imageName
            ]);
        }
    }

    public function delete(Request $request){
        $id = $request->testimonial_id;

        $testimonial = Testimonial::where('id', $id)
        ->first();
        $delete = $testimonial->delete();

        if($delete > 0){
            $this->deleteImageProject($testimonial);
            $data = [
                "title" => 'Deleted Testimonial: '.$testimonial->title,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a supprimé ce témoignage !',
                "user_id" => Auth::user()->id,
                'type' => 'testimonial_delete'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        } 
    }

    public function deleteImageProject($testimonial){
        $image_path = 'back/img/testimonials/'.$testimonial->user_image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    
}
