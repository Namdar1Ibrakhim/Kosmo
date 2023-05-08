<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register'])->middleware('auth:sanctum');

Route::post('sms-send', [AuthController::class, 'sms_send']);

Route::post('sms-auth', [AuthController::class, 'sms_auth']);

