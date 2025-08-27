<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


Route::controller(AuthController::class)->prefix('v1')->group(function () {
    Route::post('login', 'signIn');
    Route::post('register', 'signUp');
});

