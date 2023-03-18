<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddAwardToOscar extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "year" => "required|exists:oscar",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(["year" => $this->route("year")]);
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            "timestamp" => now(),
            "status" => 404,
            "message" => "Errors has been found.",
            "errors" => $validator->errors()
        ], 404);

        throw new HttpResponseException($response);
    }
}
