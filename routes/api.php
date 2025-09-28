<?php

use App\Http\Controllers\AclController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('register', 'register')->middleware('guest:sanctum')->name('register');
        Route::post('login', 'login')->middleware('guest:sanctum')->name('login');

        Route::get('/user', 'user')->middleware('auth:sanctum');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });

Route::middleware('auth:sanctum')->group(function () {
    // Post Routing
    Route::prefix('post')
        ->controller(PostController::class)
        ->group(function () {
            Route::get('{post}', 'show');
            Route::post('', 'store');
        });

    // Comment Routing
    Route::prefix('comment')
        ->controller(CommentController::class)
        ->group(function () {
            Route::post('', 'store');
        });

    // ACL Routing
    Route::prefix('acl')
        ->controller(AclController::class)
        ->group(function () {
            Route::post('role', 'roleStore');
            Route::post('permission', 'permissionStore');
        });
});
