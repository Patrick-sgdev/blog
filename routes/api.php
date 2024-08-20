<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Tags
Route::controller(TagController::class)->group(function () {
    Route::get('get-tags', 'tags');
    Route::get('get-tag/{id}', 'tag');
    Route::post('add-tag', 'store');
    Route::post('update-tag/{id}', 'update');
    Route::post('trash-tag/{id}', 'trash');
    Route::post('delete-tag/{id}', 'delete');
});

//Category
Route::controller(CategoryController::class)->group(function () {
    Route::get('get-categories', 'categories');
    Route::get('get-category/{id}', 'category');
    Route::post('add-category', 'store');
    Route::post('update-category/{id}', 'update');
    Route::post('trash-category/{id}', 'trash');
    Route::post('delete-category/{id}', 'delete');
});