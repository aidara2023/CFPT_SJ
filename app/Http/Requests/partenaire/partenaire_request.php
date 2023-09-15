<?php

namespace App\Http\Requests\partenaire;

use Illuminate\Foundation\Http\FormRequest;

class partenaire_request extends FormRequest
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
            'nom_partenaire' => 'required',
                'type' => 'required',
                'description' => 'required',
                'contact' => 'required',
                'email' => 'required|email',
                'adresse' => 'required',
                'boite_postale' => 'required',
                'date_debut' => 'required',
                'date_fin' => 'required',
                'id_direction' => 'required'
        ];
    }
}
