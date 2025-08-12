<?php

use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/users/{id}', [UserController::class, 'show']);
*/

Route::apiResource('/users', UserController::class);
Route::get('/users/export/csv', [UserController::class, 'exportCsv']);