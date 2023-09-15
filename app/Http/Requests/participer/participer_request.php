<?php

namespace App\Http\Requests\participer;

use Illuminate\Foundation\Http\FormRequest;

class participer_request extends FormRequest
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
            'date_participation' => 'required',
            'id_seminaire' => 'required',
            'id_formateur' => 'required'
        ];
    }
}
