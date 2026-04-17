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
        // Run migrations
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        
        // Clear caches just in case
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        
        return "SUCCESS: Database migrated and caches cleared successfully on cPanel!";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});
