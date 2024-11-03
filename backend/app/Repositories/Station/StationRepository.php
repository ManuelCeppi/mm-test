<?php

declare(strict_types=1);

namespace App\Repositories\Station;

use App\BusinessModels\StationAvailabilityAggregatedModel;
use App\Models\Station;
use App\Repositories\AbstractRepository;
use App\Repositories\Interfaces\StationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StationRepository extends AbstractRepository implements StationRepositoryInterface
{

    public function __construct()
    {
        parent::__construct(Station::class);
    }

    public function getStationAvailabilities(int $limit, int $offset): Collection
    {
        $stationAvailabilities = collect();
        $pdo = $this->getPDO(readInstance: true);

        $query = <<<SQL
            SELECT stations.*,
            (stations.maximum_capacity - IF(ISNULL(scooters.id), 0, COUNT(scooters.id))) as available_spots FROM stations
            LEFT JOIN scooters ON stations.id = scooters.current_station_id -- parked scooters
            GROUP BY stations.id, scooters.id
            LIMIT :limit OFFSET :offset
        SQL;

        $statement = $pdo->prepare($query);

        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $statement->execute();

        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $singleRow) {
            $station = new StationAvailabilityAggregatedModel(
                $singleRow['id'],
                $singleRow['name'],
                $singleRow['city'],
                $singleRow['street'],
                $singleRow['postal_code'],
                $singleRow['country_code'],
                $singleRow['maximum_capacity'],
                $singleRow['available_spots']
            );

            $stationAvailabilities->push($station);
        }

        return $stationAvailabilities;
    }
}
