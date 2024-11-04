<?php

declare(strict_types=1);

namespace App\Managers\User;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use App\Services\Stripe\StripeApiService;
use App\Services\User\AuthService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthManager
{

    public function __construct(
        private readonly AuthService $authService,
        private readonly UserService $userService,
        private readonly StripeApiService $stripeApiService,
    ) {}

    public function login(LoginRequest $loginRequest): string
    {
        // TODO try catch with transaction?
        $token = $this->authService->login(
            $loginRequest->email,
            $loginRequest->password
        );

        // Saving the token in the database
        /** @var User $user */
        $user = Auth::user();

        $user->auth_token = hash('sha256', $token);
        $this->userService->update($user);
        return $token;
    }

    public function register(SignUpRequest $signUpRequest): User
    {
        $user = new User();
        $user->email = $signUpRequest->email;
        $user->name = $signUpRequest->name;
        $user->surname = $signUpRequest->surname;
        $user->country_code = $signUpRequest->country_code;
        $user->phone_number = $signUpRequest->phone_number;
        $user->birth_date = $signUpRequest->birth_date;
        $user->password = bcrypt($signUpRequest->password);

        $createdUser = $this->userService->insert($user);

        // Create a customer in Stripe
        try {
            $stripeCustomer = $this->stripeApiService->createCustomer([
                "email" => $createdUser->email,
                "name" => "{$createdUser->name} {$createdUser->surname}",
            ]);
            $createdUser->payment_gateway_customer_id = $stripeCustomer->id;
            $this->userService->update($createdUser);
        } catch (\Exception $e) {
            // Log the error but no need to throw an exception, the user is already created
            Log::error('Error creating customer in Stripe: ' . $e->getMessage());
        }
        return $createdUser;
    }
}
