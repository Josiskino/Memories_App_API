<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TouristController;


Route::prefix('V1')->group(function () {

    Route::post('/login', [TouristController::class, 'login']);
    Route::post('/register', [TouristController::class, 'store']);
   
    Route::middleware(['auth:sanctum', 'role:tourist'])->group(function () {
        Route::post('/logout', [TouristController::class, 'logout']);
    });

});

/*
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    //Route::apiResource('photos', PhotoController::class);
});*/

Route::middleware(['auth:sanctum', 'role:tourist'])->group(function () {
    
});

Route::middleware(['auth:sanctum', 'role:agency'])->group(function () {
    // Routes for agencies
});


