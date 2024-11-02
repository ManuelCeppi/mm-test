<?php

namespace App\Http\Requests\Station;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string'],
            'city' => ['string'],
            'street' => ['string'],
            'postal_code' => ['string'],
            'country_code' => ['string'],
            'maximum_capacity' => ['integer'],
        ];
    }
}
