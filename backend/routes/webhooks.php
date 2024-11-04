<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/mm', function () {
    Route::middleware('stripe_webhook_middleware')->group(function () {
        Route::post('/payment_intents', [StripeController::class, 'handlePaymentIntent']);
        Route::post('/setup_intents', [StripeController::class, 'handleSetupIntent']);
    });
});
