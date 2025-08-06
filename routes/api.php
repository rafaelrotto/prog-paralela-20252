<?php

use Illuminate\Support\Facades\Route;

Route::post('/users', function () {
    return response()->json(['message' => 'User created'], 201);
});