<?php

declare(strict_types=1);

namespace App\BusinessModels;

use DateTimeInterface;

class IsUserEligibleForRentAggregatedModel
{
    public function __construct(
        public readonly int $userId,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phoneNumber,
        public readonly ?string $defaultPaymentMethodId,
        public readonly ?string $paymentGatewayCustomerId,
        public readonly ?DateTimeInterface $documentVerifiedAt,
        public readonly ?DateTimeInterface $emailVerifiedAt,
        public readonly ?string $documentVerificationId,
        public readonly int $ongoingRentalsCount,
        public readonly int $unpaidRentalsCount,
    ) {}
}
