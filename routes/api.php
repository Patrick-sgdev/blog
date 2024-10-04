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
    Route::post('rotate-key', 'rotateKey')->middleware(['checkToken']);
    Route::post('register', 'register');
});

Route::controller(PostController::class)->group(function () {
    Route::get('get-posts', 'getPosts')->middleware(['checkToken']);
    Route::get('get-post/{id}', 'getPost')->middleware(['checkToken']);
    Route::get('get-post/slug/{slug}', 'getPostSlug')->middleware(['checkToken']);
    Route::post('store-post', 'store')->name('create-post')->middleware(['checkToken']);
    Route::post('update-post/{id}', 'update')->middleware(['checkToken']);
    Route::get('get-posts-trashed', 'postsTrashed')->middleware(['checkToken']);
    Route::post('trash-post/{id}', 'trash')->middleware(['checkToken']);
    Route::post('delete-post/{id}', 'delete')->middleware(['checkToken']);
    Route::post('restore-post/{id}', 'restore')->middleware(['checkToken']);
});

//Tags
Route::controller(TagController::class)->group(function () {
    Route::get('get-tags', 'tags')->middleware(['checkToken']);
    Route::get('get-tag/{id}', 'tag')->middleware(['checkToken']);
    Route::post('create-tag', 'store')->middleware(['checkToken']);
    Route::post('update-tag/{id}', 'update')->middleware(['checkToken']);
    Route::get('get-tags-trashed', 'tagsTrashed')->middleware(['checkToken']);
    Route::post('trash-tag/{id}', 'trash')->middleware(['checkToken']);
    Route::post('delete-tag/{id}', 'delete')->middleware(['checkToken']);
    Route::post('restore-tag/{id}', 'restore')->middleware(['checkToken']);
});

//Categories
Route::controller(CategoryController::class)->group(function () {
    Route::get('get-categories', 'categories')->middleware(['checkToken']);
    Route::get('get-category/{id}', 'category')->middleware(['checkToken']);
    Route::post('create-category', 'store')->middleware(['checkToken']);
    Route::post('update-category/{id}', 'update')->middleware(['checkToken']);
    Route::get('get-categories-trashed', 'categoriesTrashed')->middleware(['checkToken']);
    Route::post('trash-category/{id}', 'trash')->middleware(['checkToken']);
    Route::post('delete-category/{id}', 'delete')->middleware(['checkToken']);
    Route::post('restore-category/{id}', 'restore')->middleware(['checkToken']);
});

//Roles
Route::controller(RoleController::class)->group(function () {
    Route::get('get-roles', 'roles')->middleware(['checkToken']);
    Route::get('get-roles-trashed', 'rolesTrashed')->middleware(['checkToken']);
    Route::get('get-role/{id}', 'role')->middleware(['checkToken']);
    Route::post('create-role', 'store')->middleware(['checkToken']);
    Route::post('update-role/{id}', 'update')->middleware(['checkToken']);
    Route::post('trash-role/{id}', 'trash')->middleware(['checkToken']);
    Route::post('delete-role/{id}', 'delete')->middleware(['checkToken']);
    Route::post('restore-role/{id}', 'restore')->middleware(['checkToken']);
});

Route::controller(UsersController::class)->group(function () {
    Route::get('get-users', 'users')->middleware(['checkToken']);
    Route::get('get-users-trashed', 'usersTrashed')->middleware(['checkToken']);
    Route::get('get-user/{id}', 'user')->middleware(['checkToken']);
    Route::post('create-user', 'store')->middleware(['checkToken']);
    Route::post('update-user/{id}', 'update')->middleware(['checkToken']);
    Route::post('trash-user/{id}', 'trash')->middleware(['checkToken']);
    Route::post('delete-user/{id}', 'delete')->middleware(['checkToken']);
    Route::post('restore-user/{id}', 'restore')->middleware(['checkToken']);
});