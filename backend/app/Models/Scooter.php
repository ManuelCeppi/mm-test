<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    protected $connection = 'mysql';
    protected $table = 'scooters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'model',
        'license_plate',
        'primary_station_id',
        'last_station_id',
        'current_station_id',
        'status',
        'battery_status'
    ];
}
