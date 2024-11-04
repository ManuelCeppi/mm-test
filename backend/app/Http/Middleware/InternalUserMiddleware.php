<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;

class InternalUserMiddleware
{

    public function handle($request, Closure $next)
    {
        // Check if the user is an internal user
        /** @var User $user */
        $user = Auth::user();
        if (!Gate::allows('mm-internal-user', $user)) {
            throw new UnauthorizedException();
        }
        return $next($request);
    }
}
