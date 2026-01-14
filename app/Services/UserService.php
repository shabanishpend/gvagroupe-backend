<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use File;
use Auth;

class UserService{

    public function isAdmin()
    {
        if(auth()->user()){
            return auth()->user()->roles()->where('role_id','=', 1)->count() > 0;
        }else{
            return null;
        }
    }

    public function isManagement()
    {
        if(auth()->user()){
            return auth()->user()->roles()->where('role_id','=', 3)->count() > 0;
        }else{
            return null;
        }
    }

    public function isAccountant()
    {
        if(auth()->user()){
            return auth()->user()->roles()->where('role_id','=', 4)->count() > 0;
        }else{
            return null;
        }
    }

    public function isDepensesManagment()
    {
        if(auth()->user()){
            return auth()->user()->roles()->where('role_id','=', 5)->count() > 0;
        }else{
            return null;
        }
    }

    public function abortForbiden(){
        // dd($this->isAdmin());
        abort(403, 'Unauthorized action.');
    }

    public function getClients($website){
        $users = $users = User::orderBy('id', 'desc')
        ->where('type', 'client')
        ->where('website', $website)
        ->get();

        return view('factures.clients.index')->with([
            'users' => $users,
            'website' => $website
        ]);
    }

    public function getClientsCreate($website){
        return view('factures.clients.create')
        ->with([
            'website' => $website
        ]);
    }

    public function getClientsUpdate($request, $website){
        return $this->getUpdate($request, $website);
    }

    public function getClientsEdit($id, $website){
        $user = User::where('id', $id)->first();

        return view('factures.clients.edit')->with([
            'user' => $user,
            'website' => $website
        ]);
    }

    public function getDeleteUser($request){
        $user = User::find($request->user_id);
        $delete = $user->delete();
        if($delete > 0){
            $data = [
                "title" => 'Deleted User: '.$user->name.' '.$user->surname,
                "description" => Auth::user()->name.' '.Auth::user()->surname.' a supprimé cet utilisateur !',
                "user_id" => Auth::user()->id,
                'type' => 'user_delete'
            ];
            return redirect()->back()->with(['success' => 'Suppression réussie !']);
        }else{
            return redirect()->back()->withInput()->withErrors(['Erreur lors de la suppression !']);
        }
    }

    public function getUpdate($request, $website = 'gvacars'){
        $fields = [
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'postal_code' => $request->postal_code,
            'type' => $request->type_user,
            'country' => $request->country,
            'website' => $website
        ];

        $request->validate([
            'name' => 'required',
            'image' => 'max:200000',
        ]);

        if($this->isAdmin()){
            if(isset($request->password)){
                $fields['password'] = Hash::make($request->password);
            }
        }

        if(isset($request->email)){
            $fields['email'] = $request->email;
        }

        if(!$this->isAdmin() && !$this->isManagement()){
            $this->abortForbiden();
        }
        if($request->type == 'create'){
            $request->validate([
                'email' => "nullable|email|unique:users,email,NULL,id",
            ]);
            $user = new User();
            $user = $user->create($fields);

            if($user){
                if(isset($request->image)){
                    $file = $request->image->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $imageName = $user->id.'-'.$filename.'.webp'; 
                    $request->image->move(public_path('back/img/users'), $imageName);

                    $user->update([
                        'image' => $imageName
                    ]);
                }
                if($request->type == 'create'){
                    $role = new RoleUser();
                    $role->role_id = $request->role;
                    $role->user_id = $user->id;
                    $role->save();
                }
                return redirect()->back()->with(['success' => 'Création réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la création !']);
            }
        }

        if($request->type == 'edit'){
            $user = User::where('id', $request->user_id)->first();

            if($request->email == $user->email){
            }else{
                $request->validate([
                    'email' => "nullable|email|unique:users,email,NULL,id",
                ]);
            }

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

                if(isset($request->role)){
                    $role = RoleUser::where('user_id', $user->id)->first();
                    $role->role_id = $request->role;
                    $role->user_id = $user->id;
                    $role->update();
                
                }

                $data = [
                    "title" => 'Updated User: '.$user->name.' '.$user->surname,
                    "description" => Auth::user()->name.' '.Auth::user()->surname.' a mis à jour un utilisateur !',
                    "user_id" => Auth::user()->id,
                    'type' => 'user_update'
                ];

                return redirect()->back()->with(['success' => 'Mise à jour réussie !']);
            }else{
                return redirect()->back()->withInput()->withErrors(['Erreur lors de la mise à jour !']);
            }

        } 

    }

}