<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/mm')->group(function () {
    // TODO internal middleware, to check if user is an internal user
    Route::prefix('/scooters')->group(function () {});
});
