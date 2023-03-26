<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NomineeWinnerOrNoWinnerRequest extends FormRequest
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
            "year" => "required|exists:oscar,year",
            "awardArtistId" => "required|exists:award_artist,id",
            "artistId" => "required|exists:artist,id",
            "winner" => "required|boolean",
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge(["year" => $this->route("year")]);
    }
    public function messages(): array
    {
        $year = $this->route("year");
        $awardArtistId = $this->get("awardArtistId");
        $artistId = $this->get("artistId");

        return [
            "year.exists" => "Ceremony hasn't been found on $year.",
            "awardArtistId.exists" => "Award hasn't been found with id: $awardArtistId.",
            "artistId.exists" => "Artist hasn't been found with id: $artistId.",
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
