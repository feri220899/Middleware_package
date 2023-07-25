<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ForgetpassController extends Controller
{
    // 1
    //  view halaman lupa password
    function forgetPassword(){
        return view('auth.forgetPassword');
    }
    // Kirim token ke email
    function mesinForgetPassword(Request $request){
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }

    // 2
    //  view halaman reset password dan membawa token
    function resetPassword(string $token){
        return view('auth.resetPassword', [
            'token' => $token
        ]);
    }
    // Mesin Mengupdate password
    function mesinResetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('statusSuccsess', __($status))
                : back()->withErrors(['email' => [__($status)]]);

    }
}
