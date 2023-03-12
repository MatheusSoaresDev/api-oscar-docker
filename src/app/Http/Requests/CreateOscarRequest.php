<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            /*"year" => "required|unique:oscar",
            "edition" => "required|unique:oscar",
            "local" => "required",
            "date" => "required|date_format:Y-m-d|after:".date("1929-05-16")."|before_or_equal:".date("Y-m-d"),
            "city" => "required",
            "hosteds" => "required|array",
            "hosteds.*" => "required",
            "curiosities" => "nullable|array",
            "curiosities.*" => "required",*/
        ];
    }
}
