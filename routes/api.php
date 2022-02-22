<?php

use App\Http\Controllers\{
    AccountController
};
use Illuminate\Support\Facades\Route;

Route::apiResource('accounts', AccountController::class);
