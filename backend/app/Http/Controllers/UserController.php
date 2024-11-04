<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Managers\User\UserManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(private readonly UserManager $userManager) {}

    public function update(UpdateUserRequest $request): Response
    {
        $user = $this->userManager->update($request);
        return response(['user' => $user], 200);
    }
}
