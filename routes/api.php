<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TouristController;
use App\Http\Controllers\Api\V1\AgencyController;


Route::prefix('V1')->group(function () {

    Route::post('tourist/login', [TouristController::class, 'login']);
    Route::post('tourist/register', [TouristController::class, 'store']);

    Route::post('agency/login', [AgencyController::class, 'login']);
    Route::post('agency/register', [AgencyController::class, 'store']);
   
    Route::middleware(['auth:sanctum', 'role:tourist'])->group(function () {
        Route::post('tourist/logout', [TouristController::class, 'logout']);
    });

    Route::middleware(['auth:sanctum', 'role:agency'])->group(function () {
        Route::post('agency/logout', [AgencyController::class, 'logout']);
    });

});



