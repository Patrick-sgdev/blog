<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(PostController::class)->group(function () {
        // Route::get('get-posts', 'posts');
        Route::get('get-post/{post}', 'post')->name('get-post');
        Route::post('create-post', 'store')->name('create-post');
        Route::post('update-post/{post}', 'update')->name('update-post');
        // Route::post('update-tag/{id}', 'update');
        // Route::post('trash-tag/{id}', 'trash');
        // Route::post('delete-tag/{id}', 'delete');
    });

});
