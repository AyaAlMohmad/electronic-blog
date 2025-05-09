<?php

use App\Http\Controllers\API\AboutUsController;
use App\Http\Controllers\API\AuthController ;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\SubSectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
// Route::post('refresh', [AuthController::class, 'refresh']);
// routes/api.php
Route::middleware('jwt.refresh')->post('/refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('register', [AuthController::class, 'register']);
Route::post('profile', [AuthController::class, 'updateProfile'])->middleware('auth:api');
Route::middleware('auth:api')->group(function(){
    Route::get('sections',[SectionController::class, 'index']);
    Route::get('sections/{id}',[SectionController::class, 'show']);

    Route::get('sub-sections',[SubSectionController::class, 'index']);
    Route::get('sub-sections/{id}',[SubSectionController::class, 'show']);
 

Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/about-us/{id}', [AboutUsController::class, 'show']);


Route::get('/contact-us', [ContactUsController::class, 'index']);
Route::get('/contact-us/{id}', [ContactUsController::class, 'show']);
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);
});