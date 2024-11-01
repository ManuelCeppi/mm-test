<?php

namespace App\Managers\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface CrudManagerInterface
{
    public function get(FormRequest $request): ?Model;
}
