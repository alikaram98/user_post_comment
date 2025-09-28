<?php

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

Route::prefix('post')
    ->middleware('auth:sanctum')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('{post}', 'show');
        Route::post('', 'store');
    });

Route::prefix('comment')
    ->middleware('auth:sanctum')
    ->controller(CommentController::class)
    ->group(function () {
        Route::post('', 'store');
    });
