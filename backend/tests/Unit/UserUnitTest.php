<?php

namespace Tests\Unit;

use App\BusinessModels\IsUserEligibleForRentAggregatedModel;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{

    public function test_user_is_eligible_for_rent(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userService = new UserService($userRepository);

        $userEligibleForRentAggregatedModel = new IsUserEligibleForRentAggregatedModel(
            userId: 1,
            name: "Test User",
            email: "test.user@test.com",
            phoneNumber: "123456789",
            documentVerificationId: "test_document_verification_id",
            documentVerifiedAt: now(),
            paymentGatewayCustomerId: "test_payment_gateway_customer_id",
            emailVerifiedAt: now(),
            defaultPaymentMethodId: 1,
            ongoingRentalsCount: 0,
            unpaidRentalsCount: 0,
        );

        $userRepository
            ->method('getUserEligibileForRentAggregatedModel')
            ->willReturn($userEligibleForRentAggregatedModel);

        $this->assertTrue($userService->checkIfUserIsEligibleForRent(1));
    }

    public function test_user_is_not_eligible_for_rent_due_to_missing_document_verification(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userService = new UserService($userRepository);

        $userEligibleForRentAggregatedModel = new IsUserEligibleForRentAggregatedModel(
            userId: 1,
            name: "Test User",
            email: "test.user@test.com",
            phoneNumber: "123456789",
            documentVerificationId: null,
            documentVerifiedAt: now(),
            paymentGatewayCustomerId: "test_payment_gateway_customer_id",
            emailVerifiedAt: now(),
            defaultPaymentMethodId: 1,
            ongoingRentalsCount: 0,
            unpaidRentalsCount: 0,
        );

        $userRepository
            ->method('getUserEligibileForRentAggregatedModel')
            ->willReturn($userEligibleForRentAggregatedModel);

        $this->expectExceptionMessage("User must have a valid driver's license inserted");
        $this->expectException(\Exception::class);

        $userService->checkIfUserIsEligibleForRent(1);
    }

    public function test_user_is_not_eligible_for_rent_due_to_missing_email_verification(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userService = new UserService($userRepository);

        $userEligibleForRentAggregatedModel = new IsUserEligibleForRentAggregatedModel(
            userId: 1,
            name: "Test User",
            email: "test.user@test.com",
            phoneNumber: "123456789",
            documentVerificationId: "test_document_verification_id",
            documentVerifiedAt: now(),
            paymentGatewayCustomerId: "test_payment_gateway_customer_id",
            emailVerifiedAt: null,
            defaultPaymentMethodId: 1,
            ongoingRentalsCount: 0,
            unpaidRentalsCount: 0,
        );

        $userRepository
            ->method('getUserEligibileForRentAggregatedModel')
            ->willReturn($userEligibleForRentAggregatedModel);

        $this->expectExceptionMessage("User must have a verified email!");
        $this->expectException(\Exception::class);

        $userService->checkIfUserIsEligibleForRent(1);
    }

    public function test_user_is_not_eligible_for_rent_due_to_missing_default_payment_method(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userService = new UserService($userRepository);

        $userEligibleForRentAggregatedModel = new IsUserEligibleForRentAggregatedModel(
            userId: 1,
            name: "Test User",
            email: "test.user@test.com",
            phoneNumber: "123456789",
            documentVerificationId: "test_document_verification_id",
            documentVerifiedAt: now(),
            paymentGatewayCustomerId: "test_payment_gateway_customer_id",
            emailVerifiedAt: now(),
            defaultPaymentMethodId: null,
            ongoingRentalsCount: 0,
            unpaidRentalsCount: 0,
        );

        $userRepository
            ->method('getUserEligibileForRentAggregatedModel')
            ->willReturn($userEligibleForRentAggregatedModel);

        $this->expectExceptionMessage("User must have a valid payment method!");
        $this->expectException(\Exception::class);

        $userService->checkIfUserIsEligibleForRent(1);
    }

    public function test_user_is_not_eligible_for_rent_due_to_ongoing_rents(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userService = new UserService($userRepository);

        $userEligibleForRentAggregatedModel = new IsUserEligibleForRentAggregatedModel(
            userId: 1,
            name: "Test User",
            email: "test.user@test.com",
            phoneNumber: "123456789",
            documentVerificationId: "test_document_verification_id",
            documentVerifiedAt: now(),
            paymentGatewayCustomerId: "test_payment_gateway_customer_id",
            emailVerifiedAt: now(),
            defaultPaymentMethodId: 1,
            ongoingRentalsCount: 1,
            unpaidRentalsCount: 0,
        );

        $userRepository
            ->method('getUserEligibileForRentAggregatedModel')
            ->willReturn($userEligibleForRentAggregatedModel);

        $this->expectExceptionMessage("Can't start a new rent with an ongoing one!");
        $this->expectException(\Exception::class);

        $userService->checkIfUserIsEligibleForRent(1);
    }

    public function test_user_is_not_eligible_for_rent_due_to_unpaid_rents(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userService = new UserService($userRepository);

        $userEligibleForRentAggregatedModel = new IsUserEligibleForRentAggregatedModel(
            userId: 1,
            name: "Test User",
            email: "test.user@test.com",
            phoneNumber: "123456789",
            documentVerificationId: "test_document_verification_id",
            documentVerifiedAt: now(),
            paymentGatewayCustomerId: "test_payment_gateway_customer_id",
            emailVerifiedAt: now(),
            defaultPaymentMethodId: 1,
            ongoingRentalsCount: 0,
            unpaidRentalsCount: 1,
        );

        $userRepository
            ->method('getUserEligibileForRentAggregatedModel')
            ->willReturn($userEligibleForRentAggregatedModel);

        $this->expectExceptionMessage("User has some unpaid rentals. Close the payments before starting a new rent.");
        $this->expectException(\Exception::class);

        $userService->checkIfUserIsEligibleForRent(1);
    }
}
