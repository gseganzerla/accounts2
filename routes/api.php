<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to our API',
        'status' => 'success',
        'code' => 200
    ]);
});