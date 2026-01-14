<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ActivityService;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use File;
use Auth;

class UserController extends Controller
{
    private $userService;
    private $activityService;

    public function __construct(UserService $userService, ActivityService $activityService)
    {
        $this->userService = $userService;
        $this->activityService = $activityService;
    }

    public function index(){
        $users = User::with('role.role')
        ->orderBy('id', 'desc')
        ->where('type', 'user')
        ->get();

        return view('users.index')->with([
            "users" => $users
        ]);
    }

    public function getRoles(){
        $roles = Role::orderBy('title','asc')->get();
        return $roles;
    }

    public function create(){
        if($this->userService->isAdmin()){
            return view('users.create')->with([
                'roles' => $this->getRoles()
            ]);
        }else{
            abort(403, '403 Forbidden');
        }
    }

    public function edit($user_id){
        if(($this->userService->isAdmin() || $this->userService->isDepensesManagment()) && Auth::user()->id == $user_id){
            $user = User::where('id', $user_id)->with('role.role')->first();
            $roles = Role::orderBy('title','asc')->get();
            return view('users.edit')->with([
                "user" => $user,
                'roles' => $roles
            ]);
        }else{
            abort(403, '403 Forbidden');
        }
    }

    public function update(Request $request){
      return $this->userService->getUpdate($request);
    }

    public function delete(Request $request){
        return $this->userService->getDeleteUser($request);
    }

    public function view($user_id){
        if($this->userService->isAdmin()){
            $user = User::where('id', $user_id)->with('role.role')->first();
            $roles = Role::orderBy('title','asc')->get();
            return view('users.view')->with([
                "user" => $user,
                'roles' => $roles
            ]);
        }else{
            abort(403, '403 Forbidden');
        }
    }

    public function clients($website){
        return $this->userService->getClients($website);
    }

    public function clientsCreate($website){
        return $this->userService->getClientsCreate($website);
    }

    public function clientsUpdate(Request $request, $website){
        return $this->userService->getClientsUpdate($request, $website);
    }

    public function clientsEdit(Request $request, $id, $website){
        return $this->userService->getClientsEdit($id, $website);
    }

    public function clientsDelete(Request $request){
        return $this->userService->getDeleteUser($request);
    }


}
