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
            'quantite' => 'required|integer|min:1',
            'id_user' => 'nullable|exists:users,id', // Nullable car ajouté côté serveur
            'id_materiel' => 'nullable|exists:materiels,id',
            'id_consommable' => 'nullable|exists:consommables,id',
        ];
    }
}