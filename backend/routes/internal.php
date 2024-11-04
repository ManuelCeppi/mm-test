<?php

use App\Http\Controllers\RentalController;
use App\Http\Controllers\ScooterController;
use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;

/**
 * This file contains all the routes that are only accessible by internal users.
 */
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
                Route::get('/availabilities', [StationController::class, 'getStationsAvailabilities']);
                Route::get('/', [StationController::class, 'getAll']);
                Route::post('/', [StationController::class, 'insert']);
                Route::prefix('/{stationId}')->group(function () {
                    Route::get('', [StationController::class, 'get']);
                    Route::put('', [StationController::class, 'update']);
                    Route::delete('', [StationController::class, 'delete']);
                });
            });
            Route::prefix('/rentals')->group(function () {
                Route::get('/ongoing', [RentalController::class, 'getOngoingRentals']);
                Route::get('/', [RentalController::class, 'getAll']);
                Route::prefix('/{rentalId}')->group(function () {
                    Route::get('', [RentalController::class, 'get']);
                });
                Route::prefix('/users')->group(function () {
                    Route::prefix('/{userId}')->group(function () {
                        Route::get('/history', [RentalController::class, 'getRentalsHistoryByUser']);
                    });
                });
                // Could have been {status} instead of hardcoded /ongoing
            });
        });
    });
});
