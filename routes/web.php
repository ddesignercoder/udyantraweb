<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestPanelController;
use App\Http\Controllers\PaymentController;
// Route::get('/', function () {
//     return view('welcome');
// });

    //demo package page
    Route::get('/', function () {
    return view('pages.package');})->name('home');;


// Route::get('/', [AuthController::class, 'index'])->name('home');
Route::view('/login', 'auth.login')->name('login'); 
Route::view('/register', 'auth.register')->name('register');

// API
Route::post('/login-api', [AuthController::class, 'login'])->name('api.login');
Route::post('/register-api', [AuthController::class, 'register'])->name('api.register');

Route::middleware(['auth.api'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/welcome', fn () => view('pages.welcome'))->name('welcome');

    // Test Panel
    Route::get('/test-panel/{slug}', [TestPanelController::class, 'show'])->name('test-panel');
    // The "Bridge" route
    Route::post('/test-panel/submit', [TestPanelController::class, 'submit'])->name('test.submit');
    Route::get('/test-result/{id}', [TestPanelController::class, 'result'])->name('test.result');

    // Udyantra Package
    Route::get('/udyantra-package', [PaymentController::class, 'udyantraPackage'])->name('udyantra-package');
    Route::post('/payment/initiate', [PaymentController::class, 'createOrder'])->name('payment.initiate');
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
    Route::get('/payment/thank-you/{orderId}', [PaymentController::class, 'thankYou'])->name('payment.thankyou');
   
});
