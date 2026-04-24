<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// VERY IMPORTANT FOR CPANEL (NO TERMINAL ACCESS)
Route::get('/setup-cpanel-db', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        // 2. Then run fresh migrations and SEED the data
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        return "SUCCESS: Caches cleared and Database migrated successfully on cPanel!";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});

// AUTO-DIAGNOSTIC TOOL TO FIND THE EXACT SERVER FIX
Route::get('/db-test', function() {
    $results = "<h3>cPanel MySQL Diagnostic Tool (Deep Scan)</h3><br>";
    $db = env('DB_DATABASE');
    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');
    
    // Find exactly what this specific cPanel server thinks the socket is
    $php_socket = ini_get('pdo_mysql.default_socket') ?: ini_get('mysqli.default_socket');
    $results .= "<strong>Your cPanel's Internal Configured Socket:</strong> " . ($php_socket ?: "NOT SET") . "<br><br>";
    
    $tests = [
        ['name' => 'Internal Configured Socket', 'dsn' => "mysql:unix_socket=$php_socket;dbname=$db"],
        ['name' => 'TCP/IP (127.0.0.1:3306)', 'dsn' => "mysql:host=127.0.0.1;port=3306;dbname=$db"],
        ['name' => 'Cloud Host (jerzy.lk)', 'dsn' => "mysql:host=jerzy.lk;port=3306;dbname=$db"]
    ];

    foreach ($tests as $test) {
        if (strpos($test['dsn'], '=;') !== false) continue; // Skip empty sockets
        
        $results .= "Testing " . $test['name'] . "... ";
        try {
            $pdo = new \PDO($test['dsn'], $user, $pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $results .= "<strong style='color:green;'>SUCCESS! Use this!</strong><br>";
        } catch (\PDOException $e) {
            $results .= "<span style='color:red;'>Failed: " . $e->getMessage() . "</span><br>";
        }
    }
    
    return $results;
});

// ADMIN PORTAL ROUTES
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminPackageController;
use App\Http\Controllers\AdminInquiryController;
use App\Http\Controllers\AdminBookingController;

use App\Http\Controllers\AdminBlogCategoryController;
use App\Http\Controllers\AdminBlogPostController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminGalleryController;

// Group C: Social & Partners
use App\Http\Controllers\AdminTestimonialController;
use App\Http\Controllers\AdminTripadvisorController;
use App\Http\Controllers\AdminPartnerController;

// Group D: Frontend Interface
use App\Http\Controllers\AdminHeroSlideController;
use App\Http\Controllers\AdminWhyChooseUsController;
use App\Http\Controllers\AdminAboutUsController;
use App\Http\Controllers\AdminNavbarController;
use App\Http\Controllers\AdminFooterController;
use App\Http\Controllers\AdminSettingController;

Route::prefix('admin')->group(function () {
    // Guest Admin Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });
    
    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Group A: Tourism Core
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('packages', AdminPackageController::class);
        Route::resource('inquiries', AdminInquiryController::class)->only(['index', 'show', 'destroy', 'update']);
        Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy', 'update']);

        // Group B: Content & Assets
        Route::resource('blog-categories', AdminBlogCategoryController::class);
        Route::resource('blog-posts', AdminBlogPostController::class);
        Route::resource('services', AdminServiceController::class);
        Route::resource('gallery', AdminGalleryController::class);

        // Group C: Social & Partners
        Route::resource('testimonials', AdminTestimonialController::class);
        Route::resource('tripadvisor', AdminTripadvisorController::class);
        Route::resource('partners', AdminPartnerController::class);

        // Group D: Frontend Interface
        Route::resource('hero-slides', AdminHeroSlideController::class);
        Route::resource('why-choose-us', AdminWhyChooseUsController::class);
        Route::get('about-us', [AdminAboutUsController::class, 'edit'])->name('about-us.edit');
        Route::post('about-us', [AdminAboutUsController::class, 'update'])->name('about-us.update');
        Route::resource('navbar-items', AdminNavbarController::class);
        Route::resource('footer-items', AdminFooterController::class);

        // Step 7: System Governance
        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
