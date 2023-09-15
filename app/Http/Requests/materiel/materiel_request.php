<?php

namespace App\Http\Requests\materiel;

use Illuminate\Foundation\Http\FormRequest;

class materiel_request extends FormRequest
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

            'Nom' => 'required',
            'date_entree' => 'required',
            'date_sortie' => 'required',
            'Etat' => 'required',
            'Quantité' => 'required',
            'id_service' => 'required',
            'id_salle' => 'required',
            'id_type_materiel' => 'required',
            'id_statut' => 'required',
             'id_unite_formation' => 'required'
        ];
    }
}
