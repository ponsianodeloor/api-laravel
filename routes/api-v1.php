<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello_world', function (){
    return "Hello World API Laravel";
});

Route::controller(UserController::class)->group(function (){
    Route::get('/users/{username}', 'show')->name('api.v1.users.show');

    Route::post('/users/store', 'store')->name('api.v1.users.store');
});

Route::controller(CategoryController::class)->group(function (){
    Route::get('/categories/', 'index')->name('api.v1.categories.index');
    Route::get('/categories_filter/', 'indexScopeFilter')->name('api.v1.categories.index_scope_filter');
    Route::get('/categories_sort/', 'indexScopeSort')->name('api.v1.categories.index_scope_sort');
    Route::get('/categories_get_or_paginate/', 'indexScopeGetOrPaginate')->name('api.v1.categories.index_scope_get_or_paginate');
    Route::get('/categories/{category}', 'show')->name('api.v1.categories.show');
    Route::get('/categories_posts/{category}', 'showPosts')->name('api.v1.categories.show_posts');
    Route::get('/categories_posts_user/{category}', 'showPostsUser')->name('api.v1.categories.show_posts_user');
    Route::get('/categories_scopes/{category}', 'showScopes')->name('api.v1.categories.show_scopes');

    Route::post('/categories/', 'store')->name('api.v1.categories.store');
    Route::put('/categories/{category}', 'store')->name('api.v1.categories.update');
    Route::delete('/category/{category}', 'delete')->name('api.v1.categories.delete');
});

//Route::apiResource('categories', CategoryController::class)->names('api.v1.categories');


