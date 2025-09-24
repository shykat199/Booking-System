<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('tasks');
        Route::post('/save-tasks', 'store')->name('save-tasks');
        Route::post('/tasks/{task}/update', 'update')->name('update-tasks');
        Route::post('/tasks/{task}/delete', 'destroy')->name('delete-tasks');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog-list', 'index')->name('blog');
        Route::get('/create-blog', 'create')->name('create-blog');
        Route::get('/edit-blog/{blog:slug}', 'edit')->name('edit-blog');
        Route::post('/save-blog', 'store')->name('save-blog');
        Route::put('/update-blog/{blog:slug}', 'update')->name('update-blog');
        Route::get('/delete-blog/{blog:slug}', 'destroy')->name('delete-blog');
        Route::post('/delete-blog-image', 'deleteImage')->name('delete-blog-image');
    });

});
