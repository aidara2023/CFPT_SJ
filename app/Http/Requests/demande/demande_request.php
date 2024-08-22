<?php

namespace App\Http\Requests\demande;

use Illuminate\Foundation\Http\FormRequest;

class demande_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autoriser la requête
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_demande' => 'required|string|in:materiel,consommable,both',
            'quantite_materiel' => 'nullable|required_if:type_demande,materiel,both|integer|min:1',
            'quantite_consommable' => 'nullable|required_if:type_demande,consommable,both|integer|min:1',
            'description_materiel' => 'nullable|string|max:1000',
            'description_consommable' => 'nullable|string|max:1000',
            'id_user' => 'nullable|exists:users,id', // Nullable car ajouté côté serveur
        ];
    }
}
