<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('users',[AuthController::class,'users']);
// Route::post('users/create',[AuthController::class,'store']);
// Route::post('users/login',[AuthController::class,'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes - Requires authentication
Route::get('users', [AuthController::class,'users']);
Route::post('users/create', [AuthController::class,'store'])->middleware('auth:api');
Route::post('users/login', [AuthController::class,'login'])->middleware('auth:api');