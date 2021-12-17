<?php

use App\Http\Controllers\API\PenjualanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BaseController;

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

Route::get('penjualan', [PenjualanController::class, 'index']);
Route::post('penjualan', [PenjualanController::class, 'create']);
Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);
Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']);
Route::get('penjualan/{id}', [PenjualanController::class, 'show']);


//Route::middleware('auth:sanctum')->group( function() {
//    Route::resource('penjualan', PenjualanController::class);
//});