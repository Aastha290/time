<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\RoutineEntryController;

// Authentication routes
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('routines', RoutineController::class);
    Route::apiResource('routine-entries', RoutineEntryController::class);
    
    Route::post('logout', [UserController::class, 'logout']);

    // Additional routes for generating reports
    Route::get('reports/weekly/{user}', [RoutineController::class, 'weeklyReport']);
    Route::get('reports/weekly/{user}/pdf', [RoutineController::class, 'weeklyReportPdf']);
    Route::get('reports/weekly/{user}/csv', [RoutineController::class, 'weeklyReportCsv']);
});
