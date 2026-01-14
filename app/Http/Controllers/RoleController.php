<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\Role;

class RoleController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        if($this->userService->isAdmin()){
            $roles = Role::orderBy('id', 'asc')->get();
            return view('roles.index')->with([
                "roles" => $roles
            ]);
        }else{
            abort(403, '403 Forbidden');
        }
    }
}
