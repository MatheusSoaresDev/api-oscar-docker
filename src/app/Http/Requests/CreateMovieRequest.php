<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateMovieRequest extends FormRequest
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
            "name" => "required|string",
            "runtime" => "required|integer",
            "release" => "required|date",
            "language" => "required|string|in:DAN,ZH,RON,POL,FR,KOR,MKD,HU,FA,ES,ARB,RU,BIS,DE,PT,IT,BS,NO,JA,EN",
            "country" => "required|string|country_code",
            "company" => "required|string",
            "wikipedia" => "required|string|active_url",
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
