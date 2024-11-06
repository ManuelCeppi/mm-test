<?php


namespace App\Http\Requests\Scooter;

use App\Enums\ScooterStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InsertScooterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uid' => ['required', 'string'],
            'name' => ['required', 'string'],
            'license_plate' => ['required', 'string'],
            'battery_level' => ['required', 'numeric'],
            'status' => ['required', Rule::enum(ScooterStatus::class)],
            'primary_station_id' => ['required', 'integer'],
            'current_station_id' => ['required', 'integer'],
        ];
    }
}
