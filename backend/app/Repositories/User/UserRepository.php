<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\BusinessModels\IsUserEligibleForRentAggregatedModel;
use App\Models\User;
use App\Repositories\AbstractRepository;
use Carbon\Carbon;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function getUserEligibileForRentAggregatedModel(int $userId): IsUserEligibleForRentAggregatedModel
    {
        $pdo = $this->getPdo(readInstance: true);

        $query = <<<SQL
            SELECT 
            users.id,
            users.name,
            users.email,
            users.phone_number,
            users.default_payment_method_id,
            users.payment_gateway_customer_id,
            users.email_verified_at,
            users.document_verification_id,
            users.document_verified_at,
            (SELECT COUNT(*) FROM rentals WHERE user_id = :first_id and status = 'ongoing') as ongoing_rentals,
            (SELECT COUNT(*) FROM payment_intents WHERE user_id = :second_id and charge_status <> 'succeded') as unpaid_rentals
            FROM users
            WHERE users.id = :third_id
        SQL;

        $statement = $pdo->prepare($query);

        $statement->bindParam(':first_id', $userId, \PDO::PARAM_INT);
        $statement->bindParam(':second_id', $userId, \PDO::PARAM_INT);
        $statement->bindParam(':third_id', $userId, \PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new IsUserEligibleForRentAggregatedModel(
            userId: $result['id'],
            name: $result['name'],
            email: $result['email'],
            phoneNumber: $result['phone_number'],
            defaultPaymentMethodId: $result['default_payment_method_id'],
            paymentGatewayCustomerId: $result['payment_gateway_customer_id'],
            emailVerifiedAt: $result['email_verified_at'] != null ? Carbon::parse($result['email_verified_at']) : null,
            documentVerificationId: $result['document_verification_id'],
            documentVerifiedAt: $result['document_verified_at'] != null ? Carbon::parse($result['document_verified_at']) : null,
            ongoingRentalsCount: $result['ongoing_rentals'],
            unpaidRentalsCount: $result['unpaid_rentals'],
        );
    }
}
