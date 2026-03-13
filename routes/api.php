<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Superadmin\ClientsController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::prefix('superadmin')->middleware('auth:sanctum')->group(function () {
    // Clients
    Route::post('/clients/invite', [ClientsController::class, 'invite']);
    Route::post('/clients', [ClientsController::class, 'index']);

    // Short Urls
    Route::post('/clients', [ClientsController::class, 'index']);
});
