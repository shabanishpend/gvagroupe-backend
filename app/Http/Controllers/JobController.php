<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobCategory;
use App\Models\Job;

class JobController extends Controller
{
    public function index(){
        return view('jobs.index')->with([
            "jobs" => $this->getJobs()
        ]);
    }

    public function create(){
        return view('jobs.create')->with([
            'categories' => $this->getJobCategories(),
        ]);
    }

    public function edit($id){
        $job = Job::where('id', $id)->first();
        $categories = JobCategory::orderBy('title', 'asc')->get();
        return view('jobs.edit')->with([
            'job' => $job,
            'categories' => $categories 
        ]);
    }

    public function delete(Request $request){
        $job = Job::where('id', $request->job_id);
        $delete = $job->delete();

        if($delete > 0){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'experience' => 'required',
            'job_category' => 'required'
        ]);

        $fields = [
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'from' => $request->date_from,
            'to' => $request->date_from,
            'experience' => $request->experience,
            'job_category_id'=> (int)$request->job_category
        ];

        if($request->type == 'create'){
            $job = new Job();
            $create = $job->create($fields);

            if($create){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $job = Job::where('id',$request->job_id);
            $update = $job->update($fields);

            if($update > 0){
                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }
        }

    }

    public function categories(){
        $categories = JobCategory::orderBy('created_at', 'desc')
        ->get();
        return view('jobs.categories.index')->with([
            "categories" => $categories
        ]);
    }

    public function categoriesCreate(){
        return view('jobs.categories.create');
    }

    public function categoriesEdit($id){
        $jobCategory = JobCategory::where('id', $id)->first();

        return view('jobs.categories.edit')->with([
            "jobCategory" => $jobCategory,
        ]);
    }

    public function categoriesUpdate(Request $request){

        $fields = [
            "title" => $request->title,
        ];

        if($request->type == 'create'){
            $jobCategory = new JobCategory();
            
            $create = $jobCategory->create($fields);

            if($create){
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $jobCategory = JobCategory::where('id', $request->id)->first();
            $update = $jobCategory->update($fields);

            if($update > 0){
                return redirect()->back()->with(['success' => 'Édité avec succès !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Error on editing!']);
            }

        }
    }

    public function categoriesDelete(Request $request){
        $jobCategory = JobCategory::where('id',$request->job_category_id);
        $delete = $jobCategory->delete();

        if($delete > 0){
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getJobCategories(){
        $categories = JobCategory::orderBy('created_at', 'desc')->get();
        return $categories;
    }

    protected function getJobs(){
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return $jobs;
    }
}
