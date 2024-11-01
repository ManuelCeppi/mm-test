<?php

declare(strict_types=1);

namespace App\Managers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use App\Services\AuthService;

class AuthManager
{

    public function __construct(
        private readonly AuthService $authService,
        private readonly UserService $userService
    ) {}

    public function login(LoginRequest $loginRequest): string
    {
        $token = $this->authService->login(
            $loginRequest->email,
            $loginRequest->password
        );

        return $token;
    }

    public function register(SignUpRequest $signUpRequest): User {}
}
