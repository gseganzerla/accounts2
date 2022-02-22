<?php

use App\Http\Controllers\{
    AccountController
};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class, function () {
    Route::post('/auth/register', 'register')->name('auth.register');
    Route::post('/auth/login', 'login')->name('auth.login');
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('accounts', AccountController::class);
});
