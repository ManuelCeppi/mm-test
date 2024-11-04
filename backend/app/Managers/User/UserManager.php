<?php

namespace App\Managers\User;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;

class UserManager
{
    public function __construct(private readonly UserService $userService) {}

    public function update(UpdateUserRequest $updateUserRequest): User
    {
        /** @var User $user */
        $user = Auth::user();
        $user->fill($updateUserRequest->validated());
        $user = $this->userService->update($user);
        return $user;
    }
}
