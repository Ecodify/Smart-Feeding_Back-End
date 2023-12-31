<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\DevicesController;
use App\Http\Controllers\Api\DevicesBackupController;

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

Route::prefix('/v1')->group(function () {

    Route::get('/', function () {
        return response()->json([
            'message' => 'Welcome to API v1',
            'version' => 1,
        ]);
    })->name('v1.home');


    Route::controller(UsersController::class)->group(function(){
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::delete('/logout', 'logout');
    });

    Route::controller(DevicesController::class)->group(function(){

    });

    Route::controller(DevicesBackupController::class)->group(function(){

    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
