<?php

namespace App\Presentation\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * Class FormRequest
 * @package App\Presentation\Requests
 */
abstract class FormRequest extends LaravelFormRequest
{
    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(
            ['errors' => $errors],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
