<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Traits\CanIssueToken;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    use CanIssueToken;

    /** @throws AuthenticationException */
    /** @param string $email */
    /** @param string $password */
    /** @return string $token */
    public function login(string $email, string $password): string
    {
        $validCretentials = Auth::attempt(['email' => $email, 'password' => $password]);
        if (!$validCretentials) {
            throw new AuthenticationException();
        }
        Log::info("User with email $email logged in");
        return $this->issueToken();
    }
}