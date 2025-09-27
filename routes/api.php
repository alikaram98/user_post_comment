<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('register', 'register')->middleware('guest:sanctum')->name('register');
        Route::post('login', 'login')->middleware('guest:sanctum')->name('login');

        Route::get('/user', 'user')->middleware('auth:sanctum');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });
