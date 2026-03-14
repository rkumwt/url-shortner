<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Superadmin\ClientsController;
use App\Http\Controllers\Api\Superadmin\ShortUrlsController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/user', [AuthController::class, 'user']);

Route::prefix('superadmin')->middleware('auth:sanctum')->group(function () {


    // Clients
    Route::post('/clients/invite', [ClientsController::class, 'invite']);
    Route::post('/clients', [ClientsController::class, 'index']);

    // Short Urls
    Route::post('/urls/download', [ShortUrlsController::class, 'download']);
    Route::post('/urls', [ShortUrlsController::class, 'index']);
});
