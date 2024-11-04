<?php

use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('/mm')->group(function () {
    Route::get('/healthcheck', function () {
        echo "App is running!";
    });
    // Middleware auth:api is specified on /config/auth.php file: 'guards' => ['api' => ['driver' => 'mm-token']]
    Route::prefix('/users')->middleware('auth:api')->group(function () {
        Route::get('/me', function () {
            return response(['user' => Auth::user()], 200);
        });
        Route::patch('/me', [UserController::class, 'update']);
    });
    Route::prefix('/scooters')->middleware('auth:api')->group(function () {
        Route::prefix('/{scooterUid}')->group(function () {
            Route::prefix('/rent')->group(function () {
                Route::post('/start', [RentalController::class, 'startRental']);
                Route::prefix('/{rentalId}')->group(function () {
                    Route::post('/end', [RentalController::class, 'endRental']);
                });
            });
        });
    });
});
