<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/customers', CustomerController::class);
    Route::apiResource('/appointments', AppointmentController::class);
    Route::apiResource('/employees', EmployeeController::class);
    Route::apiResource('/schedules', ScheduleController::class);
    Route::apiResource('/notifications', NotificationController::class);
    Route::apiResource('/services', ServiceController::class);

    // Endpoint adicional para actualizar disponibilidad de horarios
    Route::put('/schedules/{id}/availability', [ScheduleController::class, 'updateAvailability']);
});
