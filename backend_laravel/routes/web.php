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
    $results = "<h3>cPanel MySQL Diagnostic Tool</h3><br>";
    $db = env('DB_DATABASE');
    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');
    
    $tests = [
        ['name' => 'TCP/IP (127.0.0.1)', 'dsn' => "mysql:host=127.0.0.1;port=3306;dbname=$db"],
        ['name' => 'Unix Socket Default (localhost)', 'dsn' => "mysql:host=localhost;dbname=$db"],
        ['name' => 'cPanel Standard (/var/lib/mysql/mysql.sock)', 'dsn' => "mysql:unix_socket=/var/lib/mysql/mysql.sock;dbname=$db"],
        ['name' => 'Linux Standard (/tmp/mysql.sock)', 'dsn' => "mysql:unix_socket=/tmp/mysql.sock;dbname=$db"],
        ['name' => 'Debian Standard (/run/mysqld/mysqld.sock)', 'dsn' => "mysql:unix_socket=/run/mysqld/mysqld.sock;dbname=$db"]
    ];

    foreach ($tests as $test) {
        $results .= "Testing " . $test['name'] . "... ";
        try {
            $pdo = new \PDO($test['dsn'], $user, $pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $results .= "<strong style='color:green;'>SUCCESS! Use this configuration!</strong><br>";
            $results .= "<i>Put this in your .env:</i> <br>";
            if (strpos($test['dsn'], 'unix_socket') !== false) {
                $sock = explode('=', explode(';', $test['dsn'])[0])[1];
                $results .= "DB_HOST=localhost<br>DB_SOCKET=$sock<br><br>";
            } else if (strpos($test['dsn'], '127.0.0.1') !== false) {
                $results .= "DB_HOST=127.0.0.1<br><br>";
            } else {
                $results .= "DB_HOST=localhost<br><br>";
            }
        } catch (\PDOException $e) {
            $results .= "<span style='color:red;'>Failed: " . $e->getMessage() . "</span><br>";
        }
    }
    
    return $results;
});
