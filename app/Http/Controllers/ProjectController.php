<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectTranslation;
use App\Services\ActivityService;
use Auth;
use File;

class ProjectController extends Controller
{

    private $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function projects(){
        return response()->json([
            'projects' => $this->getProjects()
        ]);
    }

    public function getProjects(){
        $projects = Project::orderBy('created_at', 'desc')
        ->with('translation')
        ->get();

        return $projects;
    }

    public function index(){
        return view('projects.index')->with([
            'projects' => $this->getProjects()
        ]);
    }

    public function create(){
        return view('projects.create');
    }

    public function edit($id){
        $project = Project::where('id', $id)->with('translation')->first();

        return view('projects.edit')->with([
            'project' => $project
        ]);
    }

    public function singleProject($id){
        $project = Project::where('id', $id)->with('translation')->first();

        return view('front.portfolio.index')->with([
            'project' => $project
        ]);
    }

    public function update(Request $request){

        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'visit' => 'required',
            'client' => 'required',
            'service' => 'required',
        ]);

        $fields = [
            'title' => $request->title,
            'year' => $request->year,
            'visit' => $request->visit,
            'client' => $request->client,
            'service' => $request->service,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'video_url' => $request->video_url
        ];

        if($request->type == 'create'){
            $request->validate([
                'image' => 'required|max:200000',
            ]);
            $project = new Project();
            $project = $project->create($fields);

            if($project){
                $translationFields = [
                    "title_en" => $request->title_en,
                    'title_de' => $request->title_de,
                    'service_en' => $request->service_en,
                    'service_de' => $request->service_de,
                    'content_en' => $request->content_en,
                    'content_de' => $request->content_de,
                    'model_id' => $project->id
                ];
                $tranlation = new ProjectTranslation();
                $tranlation = $tranlation->create($translationFields);

                $this->saveOrUpdateImage($request->image, $project, $request->type);
                $data = [
                    "title" => 'Created Project: '.$project->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a créé un projet !',
                    "user_id" => Auth::user()->id,
                    'type' => 'project_create'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            } 
        }

        if($request->type == 'edit'){
            $project = Project::where('id', $request->project_id)->first();
            $update = $project->update($fields);

            if($update > 0){
                $translationFields = [
                    "title_en" => $request->title_en,
                    'title_de' => $request->title_de,
                    'service_en' => $request->service_en,
                    'service_de' => $request->service_de,
                    'content_en' => $request->content_en,
                    'content_de' => $request->content_de
                ];
                $tranlation = ProjectTranslation::where('model_id', $project->id)->first();
                $tranlation = $tranlation->update($translationFields);

                $this->saveOrUpdateImage($request->image, $project, $request->type);
                $data = [
                    "title" => 'Updated Project: '.$project->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour un projet !',
                    "user_id" => Auth::user()->id,
                    'type' => 'project_update'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            } 
        }
    }

    public function saveOrUpdateImage($image, $project, $type){
        if(isset($image)){
            $file = $image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $imageName = $project->id.'-'.$filename.'.webp'; 
            
            if($type == 'edit'){
                if($project->image != $imageName){
                    $image_path = 'back/img/projects/'.$imageName;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
            }

            $image->move(public_path('back/img/projects'), $imageName);

            $project = $project->update([
                "image" => $imageName
            ]);
        }
    }

    public function delete(Request $request){
        $id = $request->project_id;

        $project = Project::where('id', $id)
        ->first();
        $delete = $project->delete();

        if($delete > 0){
            $this->deleteImageProject($project);
            $data = [
                "title" => 'Deleted Project: '.$project->title,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a supprimé ce projet !',
                "user_id" => Auth::user()->id,
                'type' => 'project_delete'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        } 
    }

    public function deleteImageProject($project){
        $image_path = 'back/img/projects/'.$project->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

}
