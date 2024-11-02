<?php

use App\Http\Controllers\ScooterController;
use App\Http\Controllers\StationController;
use App\Http\Middleware\InternalUserMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/mm')->group(function () {
    Route::prefix('/backoffice')->middleware(InternalUserMiddleware::class)->group(function () {
        Route::prefix('/scooters')->group(function () {
            Route::get('/', [ScooterController::class, 'getAll']);
            Route::post('/', [ScooterController::class, 'insert']);
            Route::prefix('/{scooterId}')->group(function () {
                Route::get('', [ScooterController::class, 'get']);
                Route::put('', [ScooterController::class, 'update']);
                Route::delete('', [ScooterController::class, 'delete']);
            });
        });
        Route::prefix('/stations')->group(function () {
            Route::get('/', [StationController::class, 'getAll']);
            Route::post('/', [StationController::class, 'insert']);
            Route::prefix('/{stationId}')->group(function () {
                Route::get('', [StationController::class, 'get']);
                Route::put('', [StationController::class, 'update']);
                Route::delete('', [StationController::class, 'delete']);
            });
        });
    });
});
