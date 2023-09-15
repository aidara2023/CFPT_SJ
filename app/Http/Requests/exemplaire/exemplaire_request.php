<?php

namespace App\Http\Requests\exemplaire;

use Illuminate\Foundation\Http\FormRequest;

class exemplaire_request extends FormRequest
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
            'id_livre'=>'required',
            'id_rayon'=>'required'
        ];
    }
}
