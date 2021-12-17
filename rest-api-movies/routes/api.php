<?php

use App\Http\Controllers\ListMoviesController;
use App\Http\Controllers\JadwalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::get('list', [ListMoviesController::class, 'index']);
Route::post('list', [ListMoviesController::class, 'create']);
Route::put('/list/{id}', [ListMoviesController::class, 'update']);
Route::delete('/list/{id}', [ListMoviesController::class, 'destroy']);
Route::get('/list/{id}', [ListMoviesController::class, 'show']);

Route::get('movie', [JadwalController::class, 'index']);
Route::post('movie', [JadwalController::class, 'create']);
Route::put('/movie/{id}', [JadwalController::class, 'update']);
Route::delete('/movie/{id}', [JadwalController::class, 'destroy']);
Route::get('/movie/{id}', [JadwalController::class, 'show']);

//Route::middleware('auth:sanctum')->group( function() {
//    Route::resource('list', ListMoviesController::class);
//});

//Route::middleware('auth:sanctum')->group( function() {
//    Route::resource('movie', JadwalController::class);
//});

