<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Managers\User\AuthManager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private readonly AuthManager $authManager) {}
    public function login(LoginRequest $request)
    {
        $token = $this->authManager->login($request);
        return response(["token" => $token], 200);
    }

    public function register(SignUpRequest $request)
    {
        // Creating user
        $this->authManager->register($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'password' => bcrypt($request->password),
        ]);

        // Login
        Auth::login($user);
    }
}
