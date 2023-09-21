<?php

namespace App\Http\Requests\cours;

use Illuminate\Foundation\Http\FormRequest;

class cours_request extends FormRequest
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
        'intitule_cours' => 'required',
        'heure_debut' => 'required',
        'heure_fin' => 'required',
        'id_classe' => 'required',
        'id_formateur' => 'required',
        'id_matiere' => 'required',
        'id_salle' => 'required',
        'id_semestre' => 'required'
        ];
    }
}
