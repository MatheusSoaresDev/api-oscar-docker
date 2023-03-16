<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOscarRequest extends FormRequest
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
            "edition" => "nullable",
            "local" => "nullable",
            "date" => "nullable|date_format:Y-m-d|after:".date("1929-05-16")."|before_or_equal:".date("Y-m-d"),
            "dateYear" => "nullable|same:year",
            "city" => "nullable",
        ];
    }

    protected function prepareForValidation()
    {
        $date = $this->get("date");
        $newDate = new \DateTime($date);
        $year = $newDate->format("Y");

        $this->merge(["year" => $this->route("year")]);
        if($this->get("date")) {
            $this->merge(["dateYear" => $year]);
        }
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
