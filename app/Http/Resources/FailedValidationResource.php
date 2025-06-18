<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Validation\Validator;

class FailedValidationResource extends JsonResource
{
    protected Validator $validator;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->validator = $resource;
    }

    public function toArray($request)
    {
        $firstErrorMessage = $this->validator->errors()->first();

        return [
            'meta' => [
                'code'    => 422,
                'message' => 'Failed Validation',
            ],
            'data'   => null,
            'error' => $firstErrorMessage,
        ];
    }
}
