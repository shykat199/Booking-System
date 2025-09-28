<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\University\UniversityHomeController;


Route::controller(UniversityHomeController::class)->prefix('university')->name('university.')->group(function () {
    route::get('/', 'index')->name('home');
});
