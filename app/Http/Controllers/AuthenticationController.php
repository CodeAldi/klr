<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

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
            
            $base64 = "data:image/png;base64," . base64_encode(file_get_contents($request->file('wajah')->path()));
            $response = Http::withHeaders(['Accesstoken' => env('BIZNET_TOKEN')])
            ->post(env('BIZNET_ENDPOINT') . '/risetai/face-api/facegallery/enroll-face',[
                'user_id' => (string) $user->id,
                'user_name' => $user->name,
                'facegallery_id' => env('BIZNET_FG'),
                'trx_id' => env('BIZNET_TRX_ID'),
                'image' => $base64,
            ]);
        }else {
            $userDetail->url_photo = 'kosong';
        }
        $userDetail->save();
        return redirect()->route('login');
    }
}
