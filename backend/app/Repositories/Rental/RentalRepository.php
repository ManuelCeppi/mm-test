<?php

declare(strict_types=1);

namespace App\Repositories\Rental;

use App\BusinessModels\OngoingRentalsAggregatedModel;
use App\BusinessModels\UserRentalAggregatedModel;
use App\Enums\RentalStatus;
use App\Models\Rental;
use App\Repositories\AbstractRepository;
use App\Repositories\Interfaces\RentalRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RentalRepository extends AbstractRepository implements RentalRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Rental::class);
    }

    /** @return Collection $ongoingRentals returns a collection of OngoingRentalsAggregatedModel. */
    public function getOngoingRentals(int $limit, int $offset): Collection
    {
        $ongoingRentals = collect();

        // Getting pdo read instance
        $pdo = $this->getPdo(readInstance: true);

        $query = <<<SQL
            SELECT 
            rentals.id as rental_id,
            rentals.scooter_id as scooter_id,
            rentals.starting_station_id as starting_station_id,
            rentals.start_date as starting_rental_date,
            stations.`name` as starting_station_name,
            scooters.`name` as scooter_name,
            users.`name` as user_name,
            users.email as user_email
            FROM rentals
            JOIN scooters ON rentals.scooter_id = scooters.id
            JOIN users ON rentals.user_id = users.id
            JOIN stations ON rentals.starting_station_id = stations.id
            WHERE rentals.status = 'ongoing'
            LIMIT :limit OFFSET :offset
        SQL;

        $statement = $pdo->prepare($query);

        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $statement->execute();

        foreach ($statement->fetchAll(mode: \PDO::FETCH_ASSOC) as $singleRow) {
            $ongoingRentalAggregatedModel = new OngoingRentalsAggregatedModel(
                $singleRow['rental_id'],
                $singleRow['scooter_id'],
                $singleRow['starting_station_id'],
                $singleRow['starting_station_name'],
                Carbon::createFromTimestampUTC($singleRow['starting_rental_date']),
                $singleRow['scooter_name'],
                $singleRow['user_name'],
                $singleRow['user_email']
            );
            $ongoingRentals->push($ongoingRentalAggregatedModel);
        }

        return $ongoingRentals;
    }

    /** @return Collection $rentalsByUser returns a collection of UserRentalAggregatedModel. */
    public function getRentalsHistoryByUser(int $userId, int $limit, int $offset): Collection
    {
        $rentalsByUser = collect();

        // Getting pdo read instance
        $pdo = $this->getPdo(readInstance: true);

        $query = <<<SQL
           SELECT 
            rentals.id as rental_id,
            rentals.scooter_id as scooter_id,
            rentals.starting_station_id as starting_station_id,
            rentals.ending_station_id as ending_station_id,
            users.`name` as user_name,
            users.surname,
            users.email,
            users.phone_number,
            rentals.start_date,
            rentals.status,
            rentals.end_date,
            scooters.`name` as scooter_name,
            s.`name` as starting_station_name,
            s1.`name` as ending_station_name,
            rentals.amount,
            rentals.duration_seconds
            FROM users 
            JOIN rentals ON users.id = rentals.user_id
            JOIN scooters ON rentals.scooter_id = scooters.id
            JOIN stations s ON rentals.starting_station_id = s.id
            JOIN stations s1 ON rentals.ending_station_id = s1.id
            WHERE users.id = :userId
            ORDER BY rentals.start_date DESC
            LIMIT :limit OFFSET :offset
        SQL;

        $statement = $pdo->prepare($query);

        $statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $statement->execute();

        foreach ($statement->fetchAll(mode: \PDO::FETCH_ASSOC) as $singleRow) {
            $rentalAggregatedModel = new UserRentalAggregatedModel(
                $userId,
                $singleRow['rental_id'],
                $singleRow['starting_station_id'],
                $singleRow['ending_station_id'],
                $singleRow['scooter_id'],
                $singleRow['name'],
                $singleRow['surname'],
                $singleRow['email'],
                $singleRow['phone_number'],
                Carbon::createFromTimestampUTC($singleRow['start_date']),
                $singleRow['end_date'] ? Carbon::createFromTimestampUTC($singleRow['end_date']) : null,
                RentalStatus::from($singleRow['status']),
                $singleRow['amount'],
                $singleRow['duration_seconds'],
                $singleRow['scooter_name'],
                $singleRow['starting_station_name'],
                $singleRow['ending_station_name']
            );
            $rentalsByUser->push($rentalAggregatedModel);
        }

        return $rentalsByUser;
    }
}
