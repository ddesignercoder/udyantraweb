<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestPanelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrgUserManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestsManageController;
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
Route::get('/faq', fn () => view('menu-pages.faq'))->name('faq');
Route::get('/contact-us', fn () => view('menu-pages.contact-us'))->name('contact-us');

//Footer Pages
Route::get('/about-us', fn () => view('footer-pages.about-us'))->name('about-us');
Route::get('/terms-and-conditions', fn () => view('footer-pages.terms-and-conditions'))->name('terms-and-conditions');
Route::get('/privacy-policy', fn () => view('footer-pages.privacy-policy'))->name('privacy-policy');


// ==========================================
// PROTECTED ROUTES (Requires Session Token)
// ==========================================
Route::middleware(['auth.api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/welcome', fn () => view('pages.welcome'))->name('welcome');
    //Comman Dashboard
    Route::get('/my-dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard/packages', [PaymentController::class, 'dashboardPackages'])->name('dashboard.packages');
    Route::get('/dashboard/my-purchases', [PaymentController::class, 'myPurchases'])->name('dashboard.my-purchases');
    //Org User Management
    Route::post('/org/add-user', [OrgUserManagementController::class, 'storeUser'])->name('org.add.user');
    Route::get('/dashboard/add-user', [DashboardController::class, 'addUser'])->name('dashboard.add-user');
    Route::get('/dashboard/users', [DashboardController::class, 'listUsers'])->name('dashboard.list-users');
    Route::get('/dashboard/bulk-upload-users', [OrgUserManagementController::class, 'viewBulkUploadUsers'])->name('dashboard.bulk-upload-users');
    Route::post('/org/bulk-upload-users', [OrgUserManagementController::class, 'bulkUploadUsers'])->name('org.bulk-upload-users');
    
    //Test Management By company_admin or school_admin  
    Route::get('/dashboard/manage-tests', [TestsManageController::class, 'index'])->name('dashboard.manage-tests');
    Route::get('/purchased-packages', [TestsManageController::class, 'getPurchasedPackages'])->name('purchased-packages');
    Route::get('/assignable-users', [TestsManageController::class, 'getAssignableUsers'])->name('assignable-users');
    Route::post('/assign-test', [TestsManageController::class, 'assignTest'])->name('assign-test');
    // Self-assign not needed - individual users get automatic assignment on payment
    // Route::post('/api/self-assign-test', [TestsManageController::class, 'selfAssignTest'])->name('api.self-assign-test');
    Route::get('/subscription-stats', [TestsManageController::class, 'getSubscriptionStats'])->name('subscription-stats');
    
    //Test Perform by all users (view assigned tests)
    Route::get('/dashboard/my-tests', [TestsManageController::class, 'myTests'])->name('dashboard.my-tests');
    Route::get('/api/validate-test-access/{slug}', [TestsManageController::class, 'validateTestAccess'])->name('api.validate-test-access');
    
    
    // Test Panel
    Route::get('/test-panel/{slug}', [TestPanelController::class, 'show'])->name('test-panel');
    Route::post('/test-panel/submit', [TestPanelController::class, 'submit'])->name('test.submit');
    Route::get('/test-submit-response/{id}', [TestPanelController::class, 'testSubmittedResponse'])->name('test.submit_response');
    // User Dashboard and Test Result
    Route::get('/test-result/{id}', [TestPanelController::class, 'result'])->name('test.result');
    Route::get('/test-report-dashboard', [TestPanelController::class, 'dashboard'])->name('test.report.dashboard');
    //School or Company Access their user test dashboard
    Route::get('/user-test-dashboard/{id}', [TestPanelController::class, 'userReportDashboard'])->name('user-test-dashboard');
    Route::get('/user-test-result/{userId}/{testResultId}', [TestPanelController::class, 'userResult'])->name('user-test-result');

    // Payment Routes
    Route::post('/payment/initiate', [PaymentController::class, 'createOrder'])->name('payment.initiate');
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
    Route::get('/payment/thank-you/{orderId}', [PaymentController::class, 'thankYou'])->name('payment.thankyou');

    //Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::view('/profile/password', 'settings.edit')->name('profile.password');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
});