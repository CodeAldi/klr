<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    function index() {
        $users = User::wherenot('role','admin')->get();
        $roles = UserRole::cases();
        return view('admin.manajemenUser')->with('title','manajemen user')->with('users',$users)->with('roles',$roles);
    }
    function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = UserRole::tryFrom($validatedData['role']);
        $user->save();
        return back();
    }
    function update(Request $request) {
        $user = User::findOrFail($request->id);
        if ($user->name != $request->name) {
            $user->name = $request->name;
        }
        if ($user->email != $request->email) {
            $user->email = $request->email;
        }
        if ($user->role != $request->role) {
            $user->role = UserRole::tryFrom($request->role);
        }
        $user->save();
        return back();
    }
    function destroy(User $user) {
        $user->delete();
        return back();
    }
}
