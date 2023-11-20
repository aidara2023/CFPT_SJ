<?php

namespace App\Http\Requests\inscription;

use Illuminate\Foundation\Http\FormRequest;

class inscription_request extends FormRequest
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
            'montant' => '',
            'id_eleve' => '',
            'id_classe' => 'required',
            'id_annee_accademique' => 'required',
            'photo' => '',
            'dossier' => '',

            'nom_tuteur'=> 'required',
            'prenom_tuteur'=> 'required',
            'genre_tuteur'=> 'required',
            'adresse_tuteur'=> 'required',
            'telephone_tuteur'=> 'required',
            'date_naissance_tuteur'=> '',
            'lieu_naissance_tuteur'=> '',
            'nationalite_tuteur'=> 'required',
            'mail_tuteur'=> 'required',

            'nom_eleve'=> 'required',
            'prenom_eleve'=> 'required',
            'genre_eleve'=> 'required',
            'adresse_eleve'=> 'required',
            'telephone_eleve'=> 'required',
            'date_naissance_eleve'=> 'required',
            'lieu_naissance_eleve'=> 'required',
            'nationalite_eleve'=> 'required',
            'mail_eleve'=> 'required',

            'contact_urgence1'=> 'required',
            'contact_urgence2'=> 'required',

        ];
    }
}
