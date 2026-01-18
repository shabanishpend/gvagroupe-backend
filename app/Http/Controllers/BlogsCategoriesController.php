<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Services\UserService;
use App\Services\ActivityService;
use Auth;

class BlogsCategoriesController extends Controller
{

    private $userService;
    private $activityService;

    public function __construct(UserService $userService, ActivityService $activityService)
    {
        $this->userService = $userService;
        $this->activityService = $activityService;
    }

    public function index(){

        $blogCategories = BlogCategory::orderBy('created_at', 'desc')->get();
        return view('blogs.categories.index')->with([
            'blogCategories' => $blogCategories
        ]);
    }

    public function create(){

        return view('blogs.categories.create');
    }

    public function edit($id){

        $blogCategory = BlogCategory::where('id', $id)->first();
        return view('blogs.categories.edit')
        ->with([
            'blogCategory' => $blogCategory
        ]);
    }

    public function update(Request $request){
        
        $request->validate([
            'title_fr' => 'required',
        ]);
        
        $type = $request->type;
        
        $fields = [
            "title" => $request->title ?? $request->title_fr,
            "title_fr" => $request->title_fr,
            "title_en" => $request->title_en,
            "title_de" => $request->title_de,
            "title_sq" => $request->title_sq,
            "title_it" => $request->title_it,
            "description" => $request->description ?? $request->description_fr,
            "description_fr" => $request->description_fr,
            "description_en" => $request->description_en,
            "description_de" => $request->description_de,
            "description_sq" => $request->description_sq,
            "description_it" => $request->description_it,
        ];

        if($type == 'create'){
            $blogCategory = new BlogCategory();
            $create = $blogCategory->create($fields);
            if($create){
                $data = [
                    "title" => 'Created blog category: '.$blogCategory->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a créé une catégorie de blog !',
                    "user_id" => Auth::user()->id,
                    'type' => 'blog_category_create'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($type == 'edit'){
            $blogCategory = BlogCategory::where('id', $request->blog_id)->first();
            if($blogCategory){
                $update = $blogCategory->update($fields);
                if($update){
                    $data = [
                        "title" => 'Updated blog category: '.($blogCategory->title_fr ?? $blogCategory->title),
                        "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour une catégorie de blog !',
                        "user_id" => Auth::user()->id,
                        'type' => 'blog_category_update'
                    ];
                    $this->activityService->createActivity($data);
                    return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
                }else{
                    return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
                }
            }else{
                return redirect()->back()->withInput()->withErrors(['Catégorie de blog introuvable !']);
            }
        }
    }

    public function delete(Request $request){
        $id = $request->blog_category_id ?? $request->id;
        
        if(!$id){
            return redirect()->back()->withInput()->withErrors(['ID de catégorie manquant !']);
        }
        
        $blogCategory = BlogCategory::find($id);
        
        if(!$blogCategory){
            return redirect()->back()->withInput()->withErrors(['Catégorie de blog introuvable !']);
        }
        
        $title = $blogCategory->title;
        $delete = $blogCategory->delete();
        
        if($delete){
            $data = [
                "title" => 'Deleted Blog Category: '.$title,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a supprimé cette catégorie de blog !',
                "user_id" => Auth::user()->id,
                'type' => 'blog_category_delete'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }
}
