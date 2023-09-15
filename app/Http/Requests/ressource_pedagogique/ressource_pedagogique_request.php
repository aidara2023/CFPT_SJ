<?php

namespace App\Http\Requests\ressource_pedagogique;

use Illuminate\Foundation\Http\FormRequest;

class ressource_pedagogique_request extends FormRequest
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
            'titre_ressource_pedagogique'=>'required',
            'libelle'=>'required',
            'contenu'=>'required',
            'id_formateur'=>'required',
            'id_cour'=>'required',
            'id_eleve'=>'required',
            'id_unite_de_formation'=>'required'
        ];
    }
}
