<?php

declare(strict_types=1);

namespace App\Services;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository) {}
}
