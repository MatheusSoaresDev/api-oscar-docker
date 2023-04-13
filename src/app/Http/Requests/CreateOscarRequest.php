<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateOscarRequest extends FormRequest
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
            "year" => "required|unique:oscar",
            "edition" => "required|unique:oscar",
            "local" => "required",
            "date" => "required|date_format:Y-m-d|after:".date("1929-05-15")."|before_or_equal:".date("Y-m-d"),
            "city" => "required",
            "hosts" => "required|array",
            "hosts.*" => "required",
            "curiosities" => "nullable|array",
            "curiosities.*" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "year.unique" => "Exists a ceremony with the informed year in date.",
        ];
    }

    protected function prepareForValidation()
    {
        $date = $this->get("date");
        $newDate = new \DateTime($date);
        $year = $newDate->format("Y");

        $this->merge(["year" => $year]);
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
