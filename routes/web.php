<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [AuthController::class, 'index'])->name('home');
Route::view('/login', 'auth.login')->name('login'); 
Route::view('/register', 'auth.register')->name('register');

// API
Route::post('/login-api', [AuthController::class, 'login'])->name('api.login');
Route::post('/register-api', [AuthController::class, 'register'])->name('api.register');

Route::middleware(['auth.api'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/welcome', fn () => view('pages.welcome'))->name('welcome');
   
   
});
