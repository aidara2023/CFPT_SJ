<?php

namespace App\Http\Requests\date_emprunter;

use Illuminate\Foundation\Http\FormRequest;

class date_emprunter_request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'intitule'=>'required',

        ];
    }
}
