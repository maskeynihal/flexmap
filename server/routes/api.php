<?php

use App\Http\Controllers\Authentication\AuthenticatedUserController;
use App\Http\Controllers\Authentication\UserLoginController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::post('/login', [UserLoginController::class, 'login'])
        ->name('api.auth.login');

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::get('/me', AuthenticatedUserController::class)
            ->name('api.auth.user.me');
    });
});
