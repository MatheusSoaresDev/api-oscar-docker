<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RemoveAwardMovieFromOscarRequest extends FormRequest
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
            "awardMovie_id" => "required|exists:award_movie,id",
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge(["year" => $this->route("year")]);
        $this->merge(["awardMovie_id" => $this->route("awardMovieId")]);
    }
    public function messages(): array
    {
        $year = $this->route("year");
        $awardMovieId = $this->route("awardMovieId");

        return [
            "year.exists" => "Ceremony hasn't been found on ".$year.".",
            "awardMovie_id.exists" => "Award hasn't been found with id: ".$awardMovieId.".",
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
