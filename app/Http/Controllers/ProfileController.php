<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;

class ProfileController extends Controller
{

    public function index(){
        return view("auth.profile");
    }

    public function editProfile(){
        return view('auth.edit-profile');
    }

    public function profileUpdate(Request $request){
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'description' => 'required',
            'image' => 'max:200000',
        ]);

        $user_id = $request->user_id;
        $user = User::find($user_id);

        if($request->email == $user->email){
        }else{
            $request->validate([
                'email' => "unique:users,email,id",
            ]);
        }

        $fields = [
            'name' => $request->name,
            'surname' => $request->surname,
            'description' => $request->description
        ];

        $update = $user->update($fields);

        if($update > 0){
            if(isset($request->image)){
                $imageName = $user->id.'-'.$request->image->getClientOriginalName().'.'.$request->image->extension(); 
                if($user->image != $imageName){
                    $image_path = 'back/img/users/'.$imageName;
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $request->image->move(public_path('back/img/users'), $imageName);
                }
                
                $user->update([
                    'image' => $imageName
                ]);
            }
            return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Error on updating!']);
        }
        
    }

}
