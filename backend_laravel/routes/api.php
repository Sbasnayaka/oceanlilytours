<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HeroSlideController;
use App\Http\Controllers\Api\ContactController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/packages', [PackageController::class, 'index']);
Route::get('/packages/{id}', [PackageController::class, 'show']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/hero-slides', [HeroSlideController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
