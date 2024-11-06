<?php

namespace App\Http\Requests\demande;

use Illuminate\Foundation\Http\FormRequest;

class demande_request extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autoriser la requête
    }

    public function rules(): array
    {
        return [
            'type_demande' => 'required|string|in:materiel,consommable,both',
            'materiels' => 'required_if:type_demande,materiel,both|array',
            'materiels.*.libelle' => 'required_with:materiels|string|max:1000',
            'materiels.*.quantite' => 'required_with:materiels|integer|min:0',
            'materiels.*.description' => 'required_with:materiels|string|max:1000',
            'consommables' => 'required_if:type_demande,consommable,both|array',
            'consommables.*.libelle' => 'required_with:consommables|string|max:1000',
            'consommables.*.quantite' => 'required_with:consommables|integer|min:0',
            'consommables.*.description' => 'required_with:consommables|string|max:1000',
            'id_user' => 'nullable|exists:users,id', 
            'statut' => 'nullable|in:en_attente,validé,en_cours,reçu,rejete' 
        ];
    }
}