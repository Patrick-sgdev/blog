<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\CategoryController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::controller(PostController::class)->group(function () {
    Route::get('get-posts', 'getPosts')->middleware(['auth:sanctum']);
    Route::get('get-post/{id}', 'getPost')->middleware(['auth:sanctum']);
    Route::post('store-post', 'store')->name('create-post')->middleware(['auth:sanctum']);
    Route::post('update-post/{id}', 'update')->middleware(['auth:sanctum']);
    Route::get('get-posts-trashed', 'postsTrashed')->middleware(['auth:sanctum']);
    Route::post('trash-post/{id}', 'trash')->middleware(['auth:sanctum']);
    Route::post('delete-post/{id}', 'delete')->middleware(['auth:sanctum']);
    Route::post('restore-post/{id}', 'restore')->middleware(['auth:sanctum']);
});

//Tags
Route::controller(TagController::class)->group(function () {
    Route::get('get-tags', 'tags')->middleware(['auth:sanctum']);
    Route::get('get-tag/{id}', 'tag')->middleware(['auth:sanctum']);
    Route::post('create-tag', 'store')->middleware(['auth:sanctum']);
    Route::post('update-tag/{id}', 'update')->middleware(['auth:sanctum']);
    Route::get('get-tags-trashed', 'tagsTrashed')->middleware(['auth:sanctum']);
    Route::post('trash-tag/{id}', 'trash')->middleware(['auth:sanctum']);
    Route::post('delete-tag/{id}', 'delete')->middleware(['auth:sanctum']);
    Route::post('restore-tag/{id}', 'restore')->middleware(['auth:sanctum']);
});

//Categories
Route::controller(CategoryController::class)->group(function () {
    Route::get('get-categories', 'categories')->middleware(['auth:sanctum']);
    Route::get('get-category/{id}', 'category')->middleware(['auth:sanctum']);
    Route::post('create-category', 'store')->middleware(['auth:sanctum']);
    Route::post('update-category/{id}', 'update')->middleware(['auth:sanctum']);
    Route::get('get-categories-trashed', 'categoriesTrashed')->middleware(['auth:sanctum']);
    Route::post('trash-category/{id}', 'trash')->middleware(['auth:sanctum']);
    Route::post('delete-category/{id}', 'delete')->middleware(['auth:sanctum']);
    Route::post('restore-category/{id}', 'restore')->middleware(['auth:sanctum']);
});

//Roles
Route::controller(RoleController::class)->group(function () {
    Route::get('get-roles', 'roles')->middleware(['auth:sanctum']);
    Route::get('get-roles-trashed', 'rolesTrashed')->middleware(['auth:sanctum']);
    Route::get('get-role/{id}', 'role')->middleware(['auth:sanctum']);
    Route::post('create-role', 'store')->middleware(['auth:sanctum']);
    Route::post('update-role/{id}', 'update')->middleware(['auth:sanctum']);
    Route::post('trash-role/{id}', 'trash')->middleware(['auth:sanctum']);
    Route::post('delete-role/{id}', 'delete')->middleware(['auth:sanctum']);
    Route::post('restore-role/{id}', 'restore')->middleware(['auth:sanctum']);
});

Route::controller(UsersController::class)->group(function () {
    Route::get('get-users', 'users')->middleware(['auth:sanctum']);
    Route::get('get-users-trashed', 'usersTrashed')->middleware(['auth:sanctum']);
    Route::get('get-user/{id}', 'user')->middleware(['auth:sanctum']);
    Route::post('create-user', 'store')->middleware(['auth:sanctum']);
    Route::post('update-user/{id}', 'update')->middleware(['auth:sanctum']);
    Route::post('trash-user/{id}', 'trash')->middleware(['auth:sanctum']);
    Route::post('delete-user/{id}', 'delete')->middleware(['auth:sanctum']);
    Route::post('restore-user/{id}', 'restore')->middleware(['auth:sanctum']);
});