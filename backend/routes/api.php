<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/mm')->group(function () {
    Route::get('/healthcheck', function () {
        echo "App is running!";
    });
});
