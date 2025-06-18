<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\FailedValidationResource;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string',
            'age' => 'sometimes|required|integer',
            'room_id' => 'sometimes|required|exists:rooms,id',
        ];
    }

    // protected function passedValidation()
    // {
    //     if (!is_int($this->input('age'))) {
    //         abort(422, response()->json([
    //             'message' => 'Validation failed',
    //             'errors' => ['age' => ['Age must be an integer (not string).']],
    //         ], 422));
    //     }
    // }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(new FailedValidationResource($validator), 422)
        );
    }
}
