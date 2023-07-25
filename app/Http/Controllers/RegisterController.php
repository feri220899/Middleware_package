<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailSend;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    function register(){
        return view('auth.register');
    }

    public function mesinRegister(Request $request)
    {
        $str = Str::random(100);
        //Validasi
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'verify_key' => $str
        ]);

        // GET DATA DARI $REQUEST DAN KIRIM KE EMAIL
        $details = [
            'name' => $request->name,
            'role' => $request->role,
            'website' => 'Feng',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];
        Mail::to($request->email)->send(new MailSend($details));

        Session::flash('msgSuccssesReg', 'Registrasi Berhasil Cek Email anda untuk verifikasi');
        return redirect('/register');
    }
    // KETIKA USER MENKKLIK LINK YANG ADA DI EMAIL MAKA FUN INI AKAN DIJALANKAN
    public function verify($verify_key)
    {
        $keyCheck = User::select('verify_key')->where('verify_key', $verify_key)->exists();
        if($keyCheck){
            $user = User::where('verify_key', $verify_key)
            ->update([
                'active' => 1
            ]);
            Session::flash('message', 'Verifikasi Berhasil');
            return redirect('/');
        }else{
            return "Key Tidak Valid";
        }
    }

}
