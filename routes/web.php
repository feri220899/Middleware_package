<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgetpassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'Login'])->name('login');
    Route::post('/mesinLogin', [LoginController::class, 'mesinLogin']);

    Route::get('/login/google/redirect', [LoginController::class, 'googleRedirect'])->name('googleredirect');
    Route::get('/login/google/callback', [LoginController::class, 'googleCallback'])->name('googlecallback');


    Route::get('/register', [RegisterController::class, 'register']);
    Route::post('/mesinregister', [RegisterController::class, 'mesinRegister']);
    Route::get('/register/verify/{verify_key}', [RegisterController::class, 'verify']);

    Route::get('/forgetpassword', [ForgetpassController::class, 'forgetPassword']); //view halaman lupa password
    Route::post('/forget-password', [ForgetpassController::class, 'mesinForgetPassword'])->name('password.sendEmail');// Kirim token ke email
    Route::get('/reset-password/{token}', [ForgetpassController::class, 'resetPassword'])->name('password.reset'); // view halaman reset password dan membawa token
    Route::post('/reset-password', [ForgetpassController::class, 'mesinResetPassword'])->name('password.update'); // Mesin Mengupdate password
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/login/google/newpassword', [LoginController::class, 'googleNewpassword']);
    Route::post('/login/google/resetpassword', [LoginController::class, 'googleResetpassword'])->name('google.resetpassword');

    Route::get('/logout', [LoginController::class, 'mesinLogout']);
    Route::get('/', [HomeController::class, 'Index']);
    // Hanya Role admin
    Route::group(['middleware' => 'cekrole:admin'], function () {
        Route::get('/admin', [HomeController::class, 'Admin']);
    });
});
