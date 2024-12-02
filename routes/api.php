<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\TouristController;
use App\Http\Controllers\Api\V1\TourismSiteController;
use App\Http\Controllers\Api\V1\RoomCategoryController;
use App\Http\Controllers\Api\V1\ParticipationController;
use App\Http\Controllers\Api\V1\ReservationController;
use App\Http\Controllers\Api\V1\ExcursionController;
use App\Http\Controllers\Api\V1\PhotoController;
use App\Http\Controllers\Api\V1\AgencyController;
use App\Http\Controllers\Api\V1\RestaurantController;


Route::prefix('V1')->group(function () {

    Route::post('/login', [UserController::class, 'login']);
  
    Route::post('/register/tourist', [TouristController::class, 'store']);

    Route::post('/register/agency', [AgencyController::class, 'store']);

    Route::apiResource('tourism-sites', TourismSiteController::class);
    Route::apiResource('room-categories', RoomCategoryController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('renters', RenterController::class);
    Route::apiResource('restaurants', RestaurantController::class);
    Route::apiResource('excursions', ExcursionController::class);
    Route::apiResource('hotels', HotelController::class);
    Route::apiResource('participations', ParticipationController::class);
    
    Route::apiResource('photos', PhotoController::class);
    
    Route::get('/tourism-sites', [TourismSiteController::class, 'index']);
    Route::post('/tourism-sites', [TourismSiteController::class, 'store']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::post('/excursions', [ExcursionController::class, 'store']);
        Route::get('/excursions', [ExcursionController::class, 'index']);
        Route::post('/excursions/{excursion}/participations', [ParticipationController::class, 'store']);
        Route::delete('/excursions/{excursionId}/participations/{participationId}', [ParticipationController::class, 'cancel']);
        //Route::patch('/participations/{participation}/cancel', [ParticipationController::class, 'cancel']);
        

    });

});



// Route::middleware(['auth:sanctum', 'role:tourist'])->group(function () {
//     Route::post('tourist/logout', [TouristController::class, 'logout']);
// });
