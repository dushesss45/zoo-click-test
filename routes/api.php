<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\EquipmentTypeController;
use App\Http\Controllers\Api\AuthController;

// Роуты для оборудования
Route::prefix('equipment')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [EquipmentController::class, 'index']);              // GET /api/equipment
    Route::post('/', [EquipmentController::class, 'store']);             // POST /api/equipment
    Route::get('{equipment}', [EquipmentController::class, 'show']);     // GET /api/equipment/{id}
    Route::put('{equipment}', [EquipmentController::class, 'update']);   // PUT /api/equipment/{id}
    Route::delete('{equipment}', [EquipmentController::class, 'destroy']);// DELETE /api/equipment/{id}
});

// Роут для типов оборудования
Route::get('/equipment-type', [EquipmentTypeController::class, 'index']);

// Роут для авторизации
Route::post('/user/login', [AuthController::class, 'login']);
