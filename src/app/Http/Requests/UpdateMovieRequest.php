<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMovieRequest extends FormRequest
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
            "id" => "required|string|exists:movie,id",
            "name" => "nullable|string",
            "runtime" => "nullable|integer",
            "release" => "nullable|date",
            "language" => "nullable|string|in:DAN,ZH,RON,POL,FR,KOR,MKD,HU,FA,ES,ARB,RU,BIS,DE,PT,IT,BS,NO,JA,EN",
            "country" => "nullable|string|country_code",
            "company" => "nullable|string",
            "wikipedia" => "nullable|string|active_url",
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(["id" => $this->route("id")]);
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
