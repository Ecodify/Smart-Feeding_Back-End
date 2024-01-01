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
            'message' => 'Welcome to API v1',
            'version' => 1,
        ]);
    })->name('v1.home');


    Route::controller(UsersController::class)->group(function(){
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::get('/profile', 'profile')->middleware('auth:sanctum');
        Route::delete('/logout', 'logout');
    });

    Route::prefix('/devices')->controller(DevicesController::class)->group(function() {
        Route::post('/register', 'register');
        Route::put('/update', 'update');
        Route::get('/details', 'details');
        Route::get('/sensor', 'sensor');
    });

    Route::prefix('/devices_sensor')->controller(DevicesSensorsController::class)->group(function(){
        Route::post('/add', 'add');
        Route::get('/data', 'data');
        Route::get('/current', 'current');
    });

//    Route::prefix('/devices_backup')->controller(DevicesBackupController::class)->group(function(){
//            Route::post('/backup', 'backup');
//            Route::get('/data', 'data');
//    });


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
