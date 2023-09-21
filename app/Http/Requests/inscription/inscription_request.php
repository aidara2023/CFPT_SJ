<?php

namespace App\Http\Requests\inscription;

use Illuminate\Foundation\Http\FormRequest;

class inscription_request extends FormRequest
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
            'montant' => 'required',
            'date_inscription' => 'required',
            'id_eleve' => 'required',
            'id_classe' => 'required',
            'id_annee_academique' => 'required',
           
        ];
    }
}
