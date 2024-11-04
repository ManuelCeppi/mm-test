<?php

declare(strict_types=1);

namespace App\Managers\User;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use App\Services\User\AuthService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthManager
{

    public function __construct(
        private readonly AuthService $authService,
        private readonly UserService $userService
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
        $createdUser = $this->userService->insert(new User([
            "email" => $signUpRequest->email,
            "name" => $signUpRequest->name,
            "phone_number" => $signUpRequest->phone_number,
            "birth_date" => $signUpRequest->birth_date,
            "password" => bcrypt($signUpRequest->password),
        ]));

        return $createdUser;
    }
}
