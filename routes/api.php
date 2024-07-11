<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;


Route::prefix('V1')->group(function () {

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'store']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
    });

});

