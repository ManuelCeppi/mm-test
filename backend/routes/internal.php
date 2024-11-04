<?php

use App\Http\Controllers\RentalController;
use App\Http\Controllers\ScooterController;
use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/mm')->group(function () {
    // first check if user is authenticated
    Route::middleware('auth:api')->group(function () {
        // Check if use is an internal user
        Route::middleware('internal_user_middleware')->group(function () {
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
                Route::get('/availabilities', [StationController::class, 'getStationsAvailabilities']);
            });
            Route::prefix('/rentals')->group(function () {
                Route::get('/', [RentalController::class, 'getAll']);
                Route::post('/', [RentalController::class, 'insert']);
                Route::prefix('/{rentalId}')->group(function () {
                    Route::get('', [RentalController::class, 'get']);
                    Route::put('', [RentalController::class, 'update']);
                    Route::delete('', [RentalController::class, 'delete']);
                });
                Route::get('/history', [RentalController::class, 'getRentalsHistoryByUser']);
                // Could have been {status} instead of hardcoded /ongoing
                Route::get('/ongoing', [RentalController::class, 'getOngoingRentals']);
            });
        });
    });
});
