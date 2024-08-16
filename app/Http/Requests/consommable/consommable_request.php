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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'libelle' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'date_entree' => 'required|date',
            'id_statut' => 'required|exists:statuts,id',
            'id_departement' => 'required|exists:departements,id',
        ];
    }
}
