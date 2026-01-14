<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogCategoryRelation;
use Auth;
use File;
use App\Services\ActivityService;
use App\Services\UserService;

class BlogController extends Controller
{

    private $activityService;
    private $userService;

    public function __construct(ActivityService $activityService, UserService $userService)
    {
        $this->activityService = $activityService;
        $this->userService = $userService;
    }

    public function index(){
        $blogs = Blog::select('*')
        ->with(['categories.category', 'user'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('blogs.index')->with(['blogs' => $blogs]);
    }

    public function getCategories(){
        $categories = BlogCategory::orderBy('title', 'asc')->get();
        return $categories;
    }

    public function create(){
        $categories = BlogCategory::orderBy('title', 'asc')->get();

        return view('blogs.create')->with([
            'categories' => $this->getCategories()
        ]);
    }

    public function edit($id){
        
        $blog = Blog::where('id', $id)
        ->with(['categories.category', 'user'])
        ->first();
        $categories = BlogCategory::orderBy('title', 'asc')->get();

        return view('blogs.edit')->with([
            'blog' => $blog,
            'categories' => $this->getCategories()
        ]);
    }

    public function update(Request $request){

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required',
        ]);

        $title = $request->title;
        $content = $request->content;
        $categories = $request->categories;
        $user_id = Auth::user()->id;
        $type = $request->type;

        $fields = [
            "title" => $title,
            'user_id' => $user_id,
            "content" => $content,
        ];

        if($type == 'create'){
            $request->validate([
                'image' => 'required|max:200000',
            ]);
            $blog = new Blog();
            $blog = $blog->create($fields);
            
            if($blog){
                $this->saveOrUpdateImage($request->image, $blog, $type);
                $this->saveOrUpdateCategories($type, $categories, $blog->id);
                $data = [
                    "title" => 'Created blog: '.$blog->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a créé un blog !',
                    "user_id" => Auth::user()->id,
                    'type' => 'blog_create'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            } 
        }

        if($type == 'edit'){
            $blog = Blog::where('id', $request->blog_id)->first();
            $update = $blog->update($fields);
            
            if($update){
                $this->saveOrUpdateImage($request->image, $blog, $type);
                $this->saveOrUpdateCategories($type, $categories, $blog->id);
                $data = [
                    "title" => 'Updated blog: '.$blog->title,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour un blog !',
                    "user_id" => Auth::user()->id,
                    'type' => 'blog_update'
                ];
                $this->activityService->createActivity($data);
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            } 
        } 

    }

    public function saveOrUpdateImage($image, $blog, $type){
        if(isset($image)){
            $file = $image->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $imageName = $blog->id.'-'.$filename.'.webp'; 

            if($type == 'create'){
                $image->move(public_path('back/img/blogs'), $imageName);
            }
            
            if($type == 'edit'){
                if($blog->image != $imageName){
                    $image_path = 'back/img/blogs/'.$imageName;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $image->move(public_path('back/img/blogs'), $imageName);
                }
            }

            $blog = $blog->update([
                "image" => $imageName
            ]);
        }
    }
    
    public function saveOrUpdateCategories($type, $categories, $blog_id){
        $deleteCategories = BlogCategoryRelation::where('blog_id', $blog_id)->delete();
        
        foreach($categories as $category){
            $fieldsNewCat = [
                'blog_id' => (int)$blog_id,
                'category_id' => (int)$category
            ];
            
            $newCat = new BlogCategoryRelation();
            $newCat = $newCat->create($fieldsNewCat);
            
        }
    }

    public function delete(Request $request){

        $id = $request->blog_id;

        $blog = Blog::where('id', $id)
        ->first();
        $delete = $blog->delete();

        if($delete > 0){
            $this->deleteBlogImage($blog);
            $data = [
                "title" => 'Deleted Blog: '.$blog->title,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a supprimé ce blog !',
                "user_id" => Auth::user()->id,
                'type' => 'blog_delete'
            ];
            $this->activityService->createActivity($data);
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        } 
    }

    public function deleteBlogImage($blog){
        $image_path = 'back/img/blogs/'.$blog->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }
    
}
