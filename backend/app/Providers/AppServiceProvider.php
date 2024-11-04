<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('mm-internal-user', function (User $user) {
            return $user->checkIfIsInternalUser() === true;
        });

        Auth::viaRequest(
            'mm-token',
            function (Request $request) {
                $token = $request->bearerToken();
                if (!$token) {
                    throw new AuthenticationException();
                }
                // Looking for the user, if found with the token, set the user, otherwise throw an exception
                $user = User::where('auth_token', (string) $token)->first();
                if (!$user) {
                    throw new AuthenticationException();
                }
                return $user;
            }
        );
    }
}
