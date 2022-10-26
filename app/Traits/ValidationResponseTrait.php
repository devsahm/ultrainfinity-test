<?php

declare(strict_types=1);

namespace App\Traits;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationResponseTrait
{
    protected function failedValidation(Validator $validator)
    {
        $response = ResponseHelper::fail($validator->errors()->all());
        throw new HttpResponseException($response);
    }
}