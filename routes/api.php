<?php

use App\Http\Controllers\{
    AccountController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::apiResource('accounts', AccountController::class);
Route::apiResource('users', UserController::class);