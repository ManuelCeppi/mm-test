<?php

declare(strict_types=1);

namespace App\Http\Requests\Rental;

use Illuminate\Foundation\Http\FormRequest;

class EndRentalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'station_id' => ['required', 'integer'],
            'battery_level' => ['required', 'numeric'],
        ];
    }
}
