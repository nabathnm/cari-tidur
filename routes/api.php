<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KosanApiController;
use App\Http\Controllers\Api\PemesananApiController;

// =====================
// PUBLIC ROUTES
// =====================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public API Kosan
Route::get('/kosan', [KosanApiController::class, 'index']);
Route::get('/kosan/{id}', [KosanApiController::class, 'show']);

// =====================
// PROTECTED ROUTES
// =====================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // CRUD Kosan
    Route::post('/kosan', [KosanApiController::class, 'store']);
    Route::put('/kosan/{id}', [KosanApiController::class, 'update']);
    Route::delete('/kosan/{id}', [KosanApiController::class, 'destroy']);

    // CRUD Pemesanan
    Route::get('/pemesanan', [PemesananApiController::class, 'index']);
    Route::post('/pemesanan', [PemesananApiController::class, 'store']);
    Route::get('/pemesanan/{id}', [PemesananApiController::class, 'show']);
    Route::delete('/pemesanan/{id}', [PemesananApiController::class, 'destroy']);
});