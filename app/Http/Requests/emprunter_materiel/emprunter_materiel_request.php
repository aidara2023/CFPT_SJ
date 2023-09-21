<?php

namespace App\Http\Requests\emprunter_materiel;

use Illuminate\Foundation\Http\FormRequest;

class emprunter_materiel_request extends FormRequest
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
            'id_materiel' => 'required|integer',
            'id_user' => 'required|integer',
            'id_date_emprunt' => 'required|integer',
            'date_retour_prevue' => 'required|date',
            'date_retour_effective' => 'date|nullable',
            'statut' => 'required|string',
        
        ];
    }
}
