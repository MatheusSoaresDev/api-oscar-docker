<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateArtistRequest extends FormRequest
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
            "birth" => "required|date",
            "birthplace" => "required|string",
            "country" => "required|string",
            "wikipedia" => "required|active_url"
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
