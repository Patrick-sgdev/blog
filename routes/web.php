<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TagController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\DashboardController;

Route::get('/', function () {
    return view('welcome')->with([
        'posts' => Post::limit(3)->get(),
    ]);
});

Route::get('post/{slug}/{id}', function ($slug, $id) {
    return view('show-post')->with([
        'post' => Post::where('id', $id)->where('slug', $slug)->first(),
    ]);
})->name('show-post');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::controller(PostController::class)->group(function () {
        Route::get('posts', 'posts')->name('dashboard.posts');
        Route::post('create-post', 'store')->name('create-post');
        Route::post('update-post/{post}', 'update')->name('update-post');
        // Route::post('update-tag/{id}', 'update');
        // Route::post('trash-tag/{id}', 'trash');
        // Route::post('delete-tag/{id}', 'delete');

        Route::get('post/{post}', 'editPost')->name('dashboard.post');
        Route::get('get-post/{post}', 'post')->name('dashboard.get-post');
    });


    Route::controller(DashboardController::class)->group(function () {
        Route::get(uri: 'dashboard', action: 'index')->name('dashboard.index');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get(uri: 'categories', action: 'categories')->name('dashboard.categories');
        Route::get('category/{category}', 'edit')->name('dashboard.category');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get(uri: 'tags', action: 'tags')->name('dashboard.tags');
        Route::get('tag/{tag}', 'edit')->name('dashboard.tag');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get(uri: 'roles', action: 'roles')->name('dashboard.roles');
        Route::get('role/{role}', 'edit')->name('dashboard.role');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get(uri: 'users', action: 'users')->name('dashboard.users');
        Route::get('user/{user}', 'edit')->name('dashboard.user');
    });

});
