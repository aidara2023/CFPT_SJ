<?php

namespace App\Http\Requests\paiement;

use Illuminate\Foundation\Http\FormRequest;

class paiement_request extends FormRequest
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
            'id_paiement' => 'required',
            'id_eleve' => 'required',
            'id_caissier' => 'required',
            'id_annee_academique' => 'required',
            'mois' => 'required'
        ];
    }
}