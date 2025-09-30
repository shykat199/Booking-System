<?php

use App\Http\Controllers\University\UniversityHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\University\CountryController;
use App\Http\Controllers\University\CityController;
use App\Http\Controllers\University\ProgramsController;


Route::controller(UniversityHomeController::class)->prefix('university')->name('university.')->group(function () {
    route::get('/', 'index')->name('home');
});

Route::middleware('auth')->group(function () {

    Route::controller(CountryController::class)->group(function () {
        Route::get('/country-list', 'index')->name('country');
        Route::post('/save-country', 'store')->name('save-country');
        Route::put('/update-country/{id}', 'update')->name('update-country');
        Route::get('/delete-country/{id}', 'destroy')->name('delete-country');
    });

    Route::controller(CityController::class)->group(function () {
        Route::get('/city-list', 'index')->name('city');
        Route::post('/save-city', 'store')->name('save-city');
        Route::put('/update-city/{id}', 'update')->name('update-city');
        Route::get('/delete-city/{id}', 'destroy')->name('delete-city');
    });

    Route::controller(ProgramsController::class)->group(function () {
        Route::get('/program-list', 'index')->name('program');
        Route::post('/save-program', 'store')->name('save-program');
        Route::put('/update-program/{id}', 'update')->name('update-program');
        Route::get('/delete-program/{id}', 'destroy')->name('delete-program');
    });

});
