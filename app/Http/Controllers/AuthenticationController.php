<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticationController extends Controller
{
    function LoginView() {
        return view('auth.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    function RegisterView() {
        return view('auth.register');
    }
    function register(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = UserRole::peminjam;
        $user->save();

        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->nomor_induk = $request->nomor_induk;
        $userDetail->contact = $request->cp;
        if ($request->hasFile('wajah')) {
            $wajah = $request->file('wajah');
            $wajahName = $request->nomor_induk . '.' . $wajah->getClientOriginalExtension();
            $urlPhoto = $wajah->storeAs('public/uploads',$wajahName);
            $userDetail->url_photo = $urlPhoto;
        }else {
            $userDetail->url_photo = 'kosong';
        }
        $userDetail->save();
        return redirect()->route('login');
    }
}
