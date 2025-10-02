<?php

use App\Http\Controllers\AclController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('register', 'register')->middleware('guest:api')->name('register');
        Route::post('login', 'login')->middleware('guest:api')->name('login');

        Route::get('/user', 'user')->middleware('auth:api');
        Route::post('/logout', 'logout')->middleware('auth:api');
    });

Route::middleware('auth:api')->group(function () {
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
        ->middleware('auth:api')
        ->group(function () {
            Route::post('', 'store');
            Route::delete('/{comment}', 'delete');
            Route::put('/{comment}', 'update');
        });

    // ACL Routing
    Route::prefix('acl')
        ->controller(AclController::class)
        ->group(function () {
            Route::get('/user/{user}/role/{role}', 'userSetRole')->can('userRole', Role::class);
            Route::post('role', 'roleStore')->can('store', Role::class);

            Route::post('permission', 'permissionStore')->can('store', Permission::class);
        });
});
