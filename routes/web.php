<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('tasks');
        Route::post('/save-tasks', 'store')->name('save-tasks');
        Route::post('/tasks/{task}/update', 'update')->name('update-tasks');
        Route::post('/tasks/{task}/delete', 'destroy')->name('delete-tasks');
    });

});
