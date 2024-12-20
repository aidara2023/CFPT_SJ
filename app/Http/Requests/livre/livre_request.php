<?php

namespace App\Http\Requests\livre;

use Illuminate\Foundation\Http\FormRequest;

class livre_request extends FormRequest
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
            'titre_livre'=>'required',
            'genre' => 'nullable|string|max:255',
            'annee_publication' => 'nullable|integer|min:0',
            'exemplaire_disponible' => 'nullable|integer|min:0',
            'id_categorie'=>'required',
            'id_auteur'=>'required',
            'id_edition'=>'required',
        ];
    }
}
