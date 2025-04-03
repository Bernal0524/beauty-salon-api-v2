<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/customers', CustomerController::class);
    Route::apiResource('/appointments', AppointmentController::class);
    Route::apiResource('/employees', EmployeeController::class);
    Route::apiResource('/schedules', ScheduleController::class);
    Route::apiResource('/notifications', NotificationController::class);
    Route::post('/notifications/send', [NotificationController::class, 'send']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/profile', [AuthController::class, 'profile']);
});
