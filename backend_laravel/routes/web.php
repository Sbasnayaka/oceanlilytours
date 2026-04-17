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
        // 1. MUST CLEAR CACHE FIRST! If config is cached, it ignores your .env changes and crashes before clearing.
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        
        // 2. Then run migrations
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        
        return "SUCCESS: Caches cleared and Database migrated successfully on cPanel!";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});
