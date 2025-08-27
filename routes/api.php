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

        });

    });

});

