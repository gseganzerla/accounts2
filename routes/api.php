<?php

use App\Http\Controllers\{
    AccountController,
    AuthController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/register', 'register')->name('auth.register');
    Route::post('/auth/login', 'login')->name('auth.login');
});

Route::group(['prefix' => 'home', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('accounts', AccountController::class);
    Route::apiResource('users', UserController::class);
});

Route::get('/', function () {
    xdebug_info();
    exit;
});
