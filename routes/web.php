<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestPanelController;
use App\Http\Controllers\PaymentController;
// use Illuminate\Support\Facades\Auth; 
// Route::get('/', function () {
//     return view('welcome');
// });

// 1. Home Page
Route::get('/', [AuthController::class, 'index'])->name('home');

// ==========================================
// AUTHENTICATION ROUTES (Guest Only)
// ==========================================
Route::middleware('guest')->group(function () {
    
    // --- Login ---
    Route::view('/login', 'auth.login')->name('login'); 
    Route::post('/login-api', [AuthController::class, 'login'])->name('api.login');

    // --- New Registration Flow ---
    
    // Step 1: Selection Screen (The "Fork" page)
    Route::get('/register', [AuthController::class, 'showSelection'])->name('register.select');

    // Step 2a: Organization (School/Company) Registration
    Route::get('/register/organization', [AuthController::class, 'showOrgRegister'])->name('register.org.view');
    Route::post('/register/organization', [AuthController::class, 'registerOrganization'])->name('register.org.submit');

    // Step 2b: Individual Registration
    Route::get('/register/individual', [AuthController::class, 'showIndividualRegister'])->name('register.ind.view');
    Route::post('/register/individual', [AuthController::class, 'registerIndividual'])->name('register.ind.submit');
});

// ==========================================
// PUBLIC MENU PAGES
// ==========================================
Route::get('/pricing', [PaymentController::class, 'udyantraPackage'])->name('udyantra-package');
Route::get('/why-choose-us', fn () => view('menu-pages.why-choose-us'))->name('why-choose-us');
Route::get('/what-we-focus-on', fn () => view('menu-pages.what-we-focus-on'))->name('what-we-focus-on');
Route::get('/citations', fn () => view('menu-pages.citations'))->name('citations');


// ==========================================
// PROTECTED ROUTES (Requires Session Token)
// ==========================================
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