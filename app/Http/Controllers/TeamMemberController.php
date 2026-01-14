<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\TeamMemberTranslation;
use App\Services\ActivityService;
use File;
use Auth;

class TeamMemberController extends Controller
{

    private $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }
    
    public function index(){
        $teamMembers = TeamMember::all();
        return view('team-members.index', compact('teamMembers'));
    }

    public function create(){
        return view('team-members.create');
    }

    public function edit($id){
        $teamMember = TeamMember::with('translation')->where('id',$id)->first();
        return view('team-members.edit')->with(['teamMember'=> $teamMember]);
    }

    public function createNewMember(Request $request){
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'position' => 'required',
            'image' => 'required|max:200000',
        ]);

        $teamMember = new TeamMember();
        
        $fields = [
            "name" => $request->name,
            "surname" => $request->surname,
            "position" => $request->position,
            'linkedin' => $request->linkedin
        ];

        $teamMember = $teamMember->create($fields);
        if($teamMember){
            $translationFields = [
                'position_en' => $request->position_en,
                'position_de' => $request->position_de,
                'model_id' => $teamMember->id
            ];

            $file = $request->image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $imageName = $teamMember->id.'-'.$filename.'.webp'; 
            $request->image->move(public_path('back/img/team-members'), $imageName);

            $translation = new TeamMemberTranslation();
            $translation = $translation->create($translationFields);

            $data = [
                "title" => 'Created Team Member: '.$teamMember->name.' '.$teamMember->surname,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a créé un membre de l équipe !',
                "user_id" => Auth::user()->id,
                'type' => 'team_member_create'
            ];
            $this->activityService->createActivity($data);
            $teamMember = $teamMember->update([
                "image" => $imageName
            ]);
            return redirect()->back()->with(['success' => 'Création réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
        }   
    }

    public function updateMember(Request $request){
        $teamMember = TeamMember::find($request->team_member_id);
        
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'position' => 'required',
        ]);

        if($teamMember->image){
        }else{
            $request->validate([
                'image' => 'required|max:200000',
            ]); 
        }

        $fields = [
            "name" => $request->name,
            "surname" => $request->surname,
            "position" => $request->position,
        ];

        $translationFields = [
            'position_en' => $request->position_en,
            'position_de' => $request->position_de
        ];

        $update = $teamMember->update($fields);

        if($update > 0){
            $translation = TeamMemberTranslation::where('model_id', $request->team_member_id)->first();
            $translation = $translation->update($translationFields);

            if(!isset($teamMember->image)){
                $file = $request->image->getClientOriginalName();
                $filename = pathinfo($file, PATHINFO_FILENAME);

                $imageName = $teamMember->id.'-'.$filename.'.webp'; 
                if($teamMember->image != $imageName){
                    $image_path = 'back/img/team-members/'.$imageName;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $request->image->move(public_path('back/img/team-members'), $imageName);
                }
                
                $teamMember->update([
                    'image' => $imageName
                ]);
            }
            $data = [
                "title" => 'Updated Team Member: '.$teamMember->name.' '.$teamMember->surname,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour un membre de léquipe !',
                "user_id" => Auth::user()->id,
                'type' => 'team_member_update'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']); 
        }
    }

    public function delete(Request $request){
        $id = $request->team_member_id;

        $teamMember = TeamMember::find($id);
        $imageName = $teamMember->image;
        $delete = $teamMember->delete();
        
        if($delete > 0){
            $image_path = 'back/img/team-members/'.$imageName;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $data = [
                "title" => 'Deleted Team Member: '.$teamMember->name.' '.$teamMember->surname,
                "description" => Auth::user()->name." ".Auth::user()->surname." a supprimé ce membre de l'équipe !",
                "user_id" => Auth::user()->id,
                'type' => 'team_member_delete'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Error on deleted!']);
        }
    }
}
