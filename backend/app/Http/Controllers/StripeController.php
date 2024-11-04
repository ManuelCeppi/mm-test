<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Managers\Stripe\StripeManager;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function __construct(private readonly StripeManager $stripeManager) {}

    public function handlePaymentIntent(Request $request): Response
    {
        $this->stripeManager->managePaymentIntent($request->input('webhookEvent'));
        return response(['message' => 'payment intent handled'], 200);
    }

    public function handleSetupIntent(Request $request): Response
    {
        $this->stripeManager->manageSetupIntent($request->input('webhookEvent'));
        return response(['message' => 'setup intent handled'], 200);
    }
}
