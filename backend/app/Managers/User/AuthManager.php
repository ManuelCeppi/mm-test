<?php

declare(strict_types=1);

namespace App\Managers\User;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use App\Services\User\AuthService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;

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
        $user->auth_token = $token;
        $this->userService->update($user);
        return $token;
    }

    public function register(SignUpRequest $signUpRequest): User
    {
        $createdUser = $this->userService->insert(new User([
            "email" => $signUpRequest->email,
            "password" => bcrypt($signUpRequest->password),
        ]));

        return $createdUser;
    }
}
