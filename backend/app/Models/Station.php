<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $connection = 'mysql';
    protected $table = 'stations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city',
        'street',
        'postal_code',
        'country_code',
        'maximum_capacity'
    ];
}
