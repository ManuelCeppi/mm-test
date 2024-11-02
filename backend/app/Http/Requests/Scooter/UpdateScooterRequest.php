<?php

namespace App\Http\Requests\Scooter;

use App\Enums\ScooterStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateScooterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'license_plate' => ['string'],
            'battery_level' => ['numeric'],
            'status' => [Rule::Enum(ScooterStatus::class)],
            'primary_station_id' => ['integer'],
            'current_station_id' => ['integer'],
        ];
    }
}
