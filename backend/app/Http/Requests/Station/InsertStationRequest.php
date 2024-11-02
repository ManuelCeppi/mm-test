<?php

namespace App\Http\Requests\Station;


use Illuminate\Foundation\Http\FormRequest;


class InsertStationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'country_code' => ['required', 'string'],
            'maximum_capacity' => ['required', 'integer'],
        ];
    }
}
