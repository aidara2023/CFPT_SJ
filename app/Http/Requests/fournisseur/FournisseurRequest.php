<?php

namespace App\Http\Requests\Fournisseur;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurRequest extends FormRequest
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
            'nom' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email|unique:fournisseurs,email,' . $this->route('id'),
            'adresse' => 'nullable|string',
            'secteur_activite_id' => 'required',
            'produits_services' => 'required|string',
            'nom_contact' => 'nullable|string|max:100',
            'telephone_contact' => 'nullable|string|max:20',
            'statut' => 'required|in:actif,inactif'
        ];
    }
}