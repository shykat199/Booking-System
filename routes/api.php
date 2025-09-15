<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ServiceController;


Route::controller(AuthController::class)->prefix('v1')->group(function () {
    Route::post('login', 'signIn');
    Route::post('register', 'signUp');
});

Route::prefix('v1')->group(function () {

    Route::middleware(['auth:api', 'role_prefix'])->group(function () {

        Route::post('logout', [AuthController::class, 'logout']);

        Route::prefix('{dynamic_prefix}')->group(function () {

            Route::get('services', [ServiceController::class, 'serviceList']);
            Route::get('bookings', [ServiceController::class, 'userBookingServiceList']);
            Route::post('bookings', [ServiceController::class, 'bookService']);

            Route::middleware('is_admin')->group(function () {
                Route::post('services', [ServiceController::class, 'saveService']);
                Route::put('services/{id}', [ServiceController::class, 'updateService']);
                Route::delete('services/{id}', [ServiceController::class, 'deleteService']);
                Route::get('booking-list', [ServiceController::class, 'listOfBookings']);
            });

        });

    });

});

