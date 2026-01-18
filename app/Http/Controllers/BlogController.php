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
use App\Services\ImageService;

class BlogController extends Controller
{

    private $activityService;
    private $userService;
    private $imageService;

    public function __construct(ActivityService $activityService, UserService $userService, ImageService $imageService)
    {
        $this->activityService = $activityService;
        $this->userService = $userService;
        $this->imageService = $imageService;
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
            'title_fr' => 'required',
            'content_fr' => 'required',
            'categories' => 'required',
        ]);

        $categories = $request->categories;
        $user_id = Auth::user()->id;
        $type = $request->type;

        $fields = [
            'user_id' => $user_id,
            'title' => $request->title ?? $request->title_fr,
            'title_fr' => $request->title_fr,
            'title_en' => $request->title_en,
            'title_de' => $request->title_de,
            'title_sq' => $request->title_sq,
            'title_it' => $request->title_it,
            'content' => $request->content ?? $request->content_fr,
            'content_fr' => $request->content_fr,
            'content_en' => $request->content_en,
            'content_de' => $request->content_de,
            'content_sq' => $request->content_sq,
            'content_it' => $request->content_it,
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
            $extension = $image->getClientOriginalExtension();
            $tempImageName = $blog->id.'-'.$filename.'.'.$extension;
            $finalImageName = $blog->id.'-'.$filename.'.webp';
            $tempImagePath = public_path('back/img/blogs/'.$tempImageName);
            $finalImagePath = public_path('back/img/blogs/'.$finalImageName);

            if($type == 'create'){
                // Save original image temporarily
                $image->move(public_path('back/img/blogs'), $tempImageName);
                // Resize to 5:4 aspect ratio and convert to webp (default width 1000px)
                $this->imageService->resizeToAspectRatio54($tempImagePath, 1000, 'image/webp');
                // Update path if webp file was created
                if(File::exists($finalImagePath)){
                    $imageName = $finalImageName;
                } else {
                    $imageName = $tempImageName;
                }
            }
            
            if($type == 'edit'){
                if($blog->image != $finalImageName){
                    $oldImagePath = 'back/img/blogs/'.$blog->image;
                    if(File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                    // Save original image temporarily
                    $image->move(public_path('back/img/blogs'), $tempImageName);
                    // Resize to 5:4 aspect ratio and convert to webp (default width 1000px)
                    $this->imageService->resizeToAspectRatio54($tempImagePath, 1000, 'image/webp');
                    // Update path if webp file was created
                    if(File::exists($finalImagePath)){
                        $imageName = $finalImageName;
                    } else {
                        $imageName = $tempImageName;
                    }
                } else {
                    $imageName = $blog->image;
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
