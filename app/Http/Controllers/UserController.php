<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request){
        
        if($request->has('page')){
            $perPage = min($request->perPage ?? 10, 100);
            $usersPaginate = User::with(['branch'])->paginate($perPage);
            return $usersPaginate;
        }

        return Inertia::render('Users/Users');
    }
    
    public function edit(User $user){
        $roles = RoleType::all();
        $branches = Branch::all()->map(fn($e) => ['value' => $e->id, 'label' => $e->name]);
        return Inertia::render('Users/EditUser', compact('user', 'roles', 'branches'));
    }

    public function create(){
        $roles = RoleType::all();
        return Inertia::render('Users/EditUser', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'sign' => ['nullable', 'string', 'max:255'],
        ]);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'branch_id' => $validated['branch_id'] ?? null,
            'sign' => $validated['sign'] ?? null,
        ]);
    
        return redirect()->back()->with('success', 'Пользователь успешно создан.');
    }
    
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6'],
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'sign' => ['nullable', 'string', 'max:255'],
        ]);
    
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->branch_id = $validated['branch_id'] ?? null;
        $user->sign = $validated['sign'] ?? null;
    
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Пользователь успешно обновлён.');
    }
    
}
