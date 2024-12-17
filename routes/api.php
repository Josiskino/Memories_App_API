<?php

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
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\RenterController;
use App\Http\Controllers\Api\V1\RestaurantController;
use App\Http\Controllers\Api\V1\TourismCategoryController;
use App\Http\Controllers\Api\V1\TransactionController;

Route::prefix('V1')->group(function () {

    Route::post('/login', [UserController::class, 'login']);

    Route::post('/register/tourist', [TouristController::class, 'store']);

    Route::post('/register/agency', [AgencyController::class, 'store']);

    //Route::post('/transactions', [TransactionController::class, 'initiate']);
    Route::post('/payments/initiate', [TransactionController::class, 'initiatePayment']);
    Route::post('/payments/check-status', [TransactionController::class, 'checkPaymentStatus']);

    Route::get('/home', [HomeController::class, 'index']);

    Route::apiResource('room-categories', RoomCategoryController::class);
    Route::apiResource('tourism-categories', TourismCategoryController::class);
    //Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('renters', RenterController::class);
    Route::apiResource('restaurants', RestaurantController::class);
    Route::apiResource('excursions', ExcursionController::class);
    Route::apiResource('hotels', HotelController::class);
    Route::apiResource('participations', ParticipationController::class);
    //Route::apiResource('transactions', TransactionController::class);

    Route::apiResource('photos', PhotoController::class);

    Route::get('/tourism-sites', [TourismSiteController::class, 'index']);
    Route::post('/tourism-sites', [TourismSiteController::class, 'store']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::post('/excursions', [ExcursionController::class, 'store']);
        Route::get('/excursions', [ExcursionController::class, 'index']);
        Route::post('/excursions/{excursion}/participations', [ParticipationController::class, 'store']);
        Route::delete('/excursions/{excursionId}/participations/{participationId}', [ParticipationController::class, 'cancel']);
        Route::patch('/participations/{participation}/cancel', [ParticipationController::class, 'cancel']);

        Route::get('/reservations', [ReservationController::class, 'index']);
        Route::post('/reservations', [ReservationController::class, 'store']);
        Route::delete('/reservations/{reservationId}', [ReservationController::class, 'cancel']);
        Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel']);


    });
});



// Route::middleware(['auth:sanctum', 'role:tourist'])->group(function () {
//     Route::post('tourist/logout', [TouristController::class, 'logout']);
// });
