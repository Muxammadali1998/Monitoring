<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\EventController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[ UserController::class, 'register']);
Route::post('/login',[ UserController::class, 'login']);
Route::middleware('auth:api')->group(function(){
    Route::post('/test', [UserController::class, 'test']);
    Route::get('/user/{id}',[UserController::class, 'show']);
    Route::put('/user',[UserController::class, 'update']);
    Route::ApiResource('/worker', WorkerController::class);
    Route::post('/qrcode/{id}',[QrCodeController::class, 'qrcode']);
    Route::post('/event/{id}',[EventController::class, 'event']);

});