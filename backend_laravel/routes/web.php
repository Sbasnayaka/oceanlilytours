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
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
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
