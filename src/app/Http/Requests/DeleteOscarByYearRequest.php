<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteOscarByYearRequest extends FormRequest
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
        $year = $this->route("year");
        $this->merge(["year" => $year]);
    }

    public function messages(): array
    {
        $year = $this->route("year");

        return [
            "year.exists" => "Ceremony hasn't been found on ".$year.".",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            "timestamp" => now(),
            "status" => 500,
            "message" => "Errors has been found.",
            "details" => $validator->errors()
        ], 500);

        throw new HttpResponseException($response);
    }
}
