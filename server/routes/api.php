<?php

use App\Http\Controllers\Authentication\UserLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([], function () {
    Route::post('/login', [UserLoginController::class, 'login'])
        ->name('login');
});
