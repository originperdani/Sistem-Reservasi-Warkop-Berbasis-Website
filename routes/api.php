<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\ReservasiApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/menus', [ResourceController::class, 'getMenus']);
Route::get('/mejas', [ResourceController::class, 'getMejas']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Reservasi Routes
    Route::get('/reservasi', [ReservasiApiController::class, 'index']);
    Route::post('/reservasi', [ReservasiApiController::class, 'store']);
});
