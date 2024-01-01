<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\DevicesController;
use App\Http\Controllers\Api\DevicesSensorsController;
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
            'message' => 'Welcome to Smart Feeding API v1',
            'version' => 1,
        ]);
    })->name('v1.home');


    Route::controller(UsersController::class)->group(function(){
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::get('/profile', 'profile')->middleware('auth:sanctum');
        Route::delete('/logout', 'logout')->middleware('auth:sanctum');
    });

    Route::prefix('/devices')->controller(DevicesController::class)->group(function() {
        Route::post('/register', 'register');
        Route::post('/renew', 'renew');
        Route::post('/update', 'update')->middleware('auth:sanctum');
        Route::get('/details', 'details')->middleware('auth:sanctum');
        Route::get('/sensor', 'sensor')->middleware('auth:sanctum');
    });

    Route::prefix('/devices_sensor')->controller(DevicesSensorsController::class)->group(function(){
        Route::post('/add', 'add')->middleware('auth:sanctum');
        Route::get('/data', 'data')->middleware('auth:sanctum');
        Route::get('/current', 'current')->middleware('auth:sanctum');
    });

    Route::prefix('/devices_backup')->controller(DevicesBackupController::class)->group(function(){
            Route::post('/backup', 'backup');
            Route::get('/data', 'data');
    });
});
