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

    /** 
     * @throws \Exception
     */
    public function checkIfUserIsEligibleForRent(int $userId): bool
    {
        $isUserEligibleForRentAggregatedModel = $this->userRepository->getUserEligibileForRentAggregatedModel($userId);

        if (!$isUserEligibleForRentAggregatedModel->documentVerificationId) {
            throw new \Exception("User must have a valid driver's license inserted");
        }

        if (!$isUserEligibleForRentAggregatedModel->emailVerifiedAt) {
            throw new \Exception("User must have a verified email!");
        }

        if (!$isUserEligibleForRentAggregatedModel->defaultPaymentMethodId) {
            throw new \Exception("User must have a valid payment method!");
        }

        if ($isUserEligibleForRentAggregatedModel->ongoingRentalsCount !== 0) {
            throw new \Exception("Can't start a new rent with an ongoing one!");
        }

        if ($isUserEligibleForRentAggregatedModel->unpaidRentalsCount > 0) {
            throw new \Exception("User has some unpaid rentals. Close the payments before starting a new rent.");
        }

        return true;
    }
}
