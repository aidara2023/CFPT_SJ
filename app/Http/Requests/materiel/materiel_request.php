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

            
            'date_entree' => 'required',
            'quantite' => 'required',
            'marque' => 'required',
            'libelle' => 'required',
            'id_type_materiel' => 'required',
            'id_statut' => 'required',
             'id_departement' => 'required'
        ];
    }
}
