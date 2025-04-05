<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{

    public function index(Request $request){
        
        if($request->has('page')){
            $perPage = min($request->perpage ?? 10, 100);
            User::paginate($perPage);
        }
    }
    
    public function edit(User $user){
        $roles = RoleType::all();
        return Inertia::render('Pages/Users/EditUser', compact('user', 'roles'));
    }

    public function create(){
        $roles = RoleType::all();
        return Inertia::render('Pages/Users/EditUser', compact('roles'));
    }

    public function update(Request $request, User $user){
        //
    }

    public function store(Request $request){
        //
    }
}
