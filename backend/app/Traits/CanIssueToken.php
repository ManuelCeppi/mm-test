<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CanIssueToken
{
    function issueToken(): string
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();
        $token = $currentUser->createToken('token')->plainTextToken;
        return $token;
    }
}
