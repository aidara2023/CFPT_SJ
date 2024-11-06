<?php

namespace App\Http\Requests\consommable;

use Illuminate\Foundation\Http\FormRequest;

class consommable_request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'libelle' => 'required',
            'marque' => 'required',
            'quantite' => 'required',
            'date_entree' => 'required',
            'id_demande' => 'required',
            'id_etat' => 'required',
            'id_departement' => 'required',
        ];
    }
}
