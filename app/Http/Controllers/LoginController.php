<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // LOGIN
    function Login()
    {
        return view('auth.login');
    }
    function mesinLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('pesanSukses', 'Berhasil Login');
        }else{
            $a = User::where('email', '=', $request->email)->value('active');
            $b = User::where('email', '=', $request->email)->exists();
                if ($a==null && $b) {
                    Session::flash('error', 'Gagal Login, Email Belum Di verifikasi!');
                }else{
                    Session::flash('error', 'Gagal Login!, Cek kembali akun anda');
                }
            return redirect('/login');
        }
    }

    // LOGIN WITH GOOGLE
    function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }
    function googleCallback() {
        $userFromGoogle = Socialite::driver('google')->user();
        // Ambil user dari database berdasarkan google user id
        $userFromDatabase = User::where('email', $userFromGoogle->getEmail())->first();
        if (!$userFromDatabase) {
            $str = Str::random(100);
            $user = User::create([
                'email' => $userFromGoogle->getEmail(),
                'name' => $userFromGoogle->getName(),
                'password' => Hash::make($userFromGoogle->getEmail()),
                'role' => 'user',
                'active' => 1,
                'verify_key' => $str
            ]);
            auth('web')->login($user);
            session()->regenerate();
            return redirect()->intended('/login/google/newpassword')->with('pesanSukses', 'Silahkan buat password baru');

        }else{
            auth('web')->login($userFromDatabase);
            session()->regenerate();
            return redirect('/');
        }
    }
    function googleNewpassword() {
            return view('auth.newPassword');
    }
    function googleResetpassword(Request $request) {
        $request->validate([
            'password'=>'required'
        ]);
        User::where('email', $request->email)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended('/')->with('pesanSukses', 'Berhasil Login');
    }

    // Mesin Logout
    public function mesinLogout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/login');
    }
}

// 45454108014-tfph83om64j4q7dss9pce5h1u058g6ia.apps.googleusercontent.com     Client ID
// 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   Client secret
