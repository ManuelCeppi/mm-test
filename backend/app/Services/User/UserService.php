<?php

declare(strict_types=1);

namespace App\Services\User;

use App\BusinessModels\IsUserEligibleForRentAggregatedModel;
use App\Repositories\User\UserRepository;
use App\Services\AbstractService;

class UserService extends AbstractService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function checkIfUserIsEligibleForRent(int $userId): IsUserEligibleForRentAggregatedModel
    {
        $isUserEligibleForRentAggregatedModel = $this->userRepository->checkIfUserIsEligibleForRent($userId);
        return $isUserEligibleForRentAggregatedModel;
    }
}
