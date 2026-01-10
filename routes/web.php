<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestPanelController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth; 
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::view('/login', 'auth.login')->name('login'); 
Route::view('/register', 'auth.register')->name('register');

// Menu Pages
Route::get('/pricing', [PaymentController::class, 'udyantraPackage'])->name('udyantra-package');
Route::get('/why-choose-us', fn () => view('menu-pages.why-choose-us'))->name('why-choose-us');

// API Routes
Route::post('/login-api', [AuthController::class, 'login'])->name('api.login');
Route::post('/register-api', [AuthController::class, 'register'])->name('api.register');


Route::middleware(['auth.api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/welcome', fn () => view('pages.welcome'))->name('welcome');
    
    // Test Panel
    Route::get('/test-panel/{slug}', [TestPanelController::class, 'show'])->name('test-panel');
    Route::post('/test-panel/submit', [TestPanelController::class, 'submit'])->name('test.submit');
    Route::get('/test-submit-response/{id}', [TestPanelController::class, 'testSubmittedResponse'])->name('test.submit_response');
    // User Dashboard and Test Result
    Route::get('/test-result/{id}', [TestPanelController::class, 'result'])->name('test.result');
    Route::get('/my-dashboard', [TestPanelController::class, 'dashboard'])->name('user.dashboard');

    // Payment Routes
    Route::post('/payment/initiate', [PaymentController::class, 'createOrder'])->name('payment.initiate');
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
    Route::get('/payment/thank-you/{orderId}', [PaymentController::class, 'thankYou'])->name('payment.thankyou');
});