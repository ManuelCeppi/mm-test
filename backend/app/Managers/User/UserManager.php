<?php

namespace App\Managers\User;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\Stripe\StripeApiService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentMethod;

class UserManager
{
    public function __construct(
        private readonly UserService $userService,
        private readonly StripeApiService $stripeApiService,
    ) {}

    public function update(UpdateUserRequest $updateUserRequest): User
    {
        /** @var User $user */
        $user = Auth::user();
        $user->fill($updateUserRequest->validated());
        $user = $this->userService->update($user);
        return $user;
    }

    public function registerPaymentMethod(): string
    {
        /** @var User $user */
        $user = Auth::user();
        $setupIntent = $this->stripeApiService->createSetupIntent([
            'customer' => $user->payment_gateway_customer_id,
            // Setting metadata: this way i can reconcile the payment method with the user, in the webhook
            'metadata' => [
                'user_id' => $user->id,
            ],
        ]);

        // Secret token that will be used in the frontend to confirm the payment method
        return $setupIntent->client_secret;
    }
}
