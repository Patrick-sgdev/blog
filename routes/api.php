<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\CategoryController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::controller(PostController::class)->group(function () {
    Route::get('get-posts', 'getPosts');
    Route::get('get-post/{id}', 'getPost');
    Route::post('store-post', 'store')->name('create-post');
    Route::post('update-post/{id}', 'update');
});

//Tags
Route::controller(TagController::class)->group(function () {
    Route::get('get-tags', 'tags');
    Route::get('get-tag/{id}', 'tag');
    Route::post('create-tag', 'store');
    Route::post('update-tag/{id}', 'update');
});

//Categories
Route::controller(CategoryController::class)->group(function () {
    Route::get('get-categories', 'categories');
    Route::get('get-category/{id}', 'category');
    Route::post('create-category', 'store');
    Route::post('update-category/{id}', 'update');
});

//Roles
Route::controller(RoleController::class)->group(function () {
    Route::get('get-roles', 'roles');
    Route::get('get-role/{id}', 'role');
    Route::post('create-role', 'store');
    Route::post('update-role/{id}', 'update');
    Route::post('trash-role/{id}', 'trash');
    Route::post('delete-role/{id}', 'delete');
    Route::post('restore-role/{id}', 'restore');
});