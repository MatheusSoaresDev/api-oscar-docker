<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAwardArtistRequest extends FormRequest
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
            "id" => "required|exists:award_artist",
            "name" => "required|unique:award_artist",
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
            "status" => 404,
            "message" => "Errors has been found.",
            "errors" => $validator->errors()
        ], 404);

        throw new HttpResponseException($response);
    }
}
