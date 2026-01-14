<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class CheckRole
{
   
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function handle($request, Closure $next, $roles)
    {
        if(Auth::check()){
            $allowedRoles = explode('|', $roles); // Split roles into an array
            $userRoles = auth()->user()->roles()->pluck('roles.id')->toArray(); // Assuming you have a 'id' attribute
           
            foreach ($allowedRoles as $role) {
                if (in_array($role, $userRoles)) {
                    return $next($request);
                }
            }
        }

        // If the user does not have any of the required roles, redirect or abort
        $this->userService->abortForbiden();
    }
}
