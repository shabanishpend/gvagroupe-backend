<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivityService;
use App\Models\WorldLeadingBrand;
use Auth;
use File;

class WorldLeadingBrandController extends Controller
{
    private $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function getWorldLeadingBrands(){
        $worldleadingbrands = WorldLeadingBrand::orderBy('created_at','asc')
        ->get();
        return $worldleadingbrands;
    }

    public function getOneWorldLeadingBrand($id){
        $worldleadingbrand = WorldLeadingBrand::where('id', $id)->first();
        return $worldleadingbrand;
    }

    public function wlbs(){
        return response()->json([
            "wlbs" => $this->getWorldLeadingBrands()
        ]);
    }

    public function index(){
        return view(
            'world-leading-brands.index'
        )
        ->with([
            'world_leading_brands' => $this->getWorldLeadingBrands()
        ]);
    }

    public function create(){
        return view(
            'world-leading-brands.create'
        );
    }

    public function edit($id){
        return view(
            'world-leading-brands.edit'
        )
        ->with([
            'world_leading_brand' => $this->getOneWorldLeadingBrand($id)
        ]);
    }

    public function update(Request $request){

        $fields = [
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
        ];

        if($request->type == 'create'){
            $request->validate([
                'image' => 'required|max:200000',
            ]);

            $wlb = new WorldLeadingBrand();
            $wlb = $wlb->create($fields);

            if($wlb){
                $this->saveOrUpdateImage($request->image, $wlb, $request->type);
                $data = [
                    "title" => 'Created World Leading Brand: '.$wlb->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a créé une marque de premier plan au niveau mondial !',
                    "user_id" => Auth::user()->id,
                    'type' => 'wlb_create'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }

        }

        if($request->type == 'edit'){
            $wlb = WorldLeadingBrand::where('id', $request->id)->first();
            $update = $wlb->update($fields);

            if($update > 0){
                $this->saveOrUpdateImage($request->image, $wlb, $request->type);
                $data = [
                    "title" => 'Updated World Leading Brand: '.$wlb->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour cette marque leader au niveau mondial !',
                    "user_id" => Auth::user()->id,
                    'type' => 'wlb_update'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }

        }

    }

    public function saveOrUpdateImage($image, $wlb, $type){
        if(isset($image)){
            $file = $image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $imageName = $wlb->id.'-'.$filename.'.webp'; 
            
            if($type == 'edit'){
                if($wlb->image != $imageName){
                    $image_path = 'back/img/world-leading-brands/'.$imageName;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
            }

            $image->move(public_path('back/img/world-leading-brands'), $imageName);

            $wlb = $wlb->update([
                "image" => $imageName
            ]);
        }
    }

    public function delete(Request $request){
        $id = $request->id;

        $wlb = WorldLeadingBrand::where('id', $id)
        ->first();
        $delete = $wlb->delete();

        if($delete > 0){
            $this->deleteImageProject($wlb);
            $data = [
                "title" => 'Deleted World Leading Brand: '.$wlb->title,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' supprimé cette marque !',
                "user_id" => Auth::user()->id,
                'type' => 'wlb_delete'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        } 
    }

    public function deleteImageProject($wlb){
        $image_path = 'back/img/world-leading-brands/'.$wlb->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }
}
