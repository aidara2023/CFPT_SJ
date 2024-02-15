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
            'id_classe' => '',
            'id_annee_accademique' => '',
            'photo' => '',
            'dossier' => '',

            'nom_tuteur'=> '',
            'prenom_tuteur'=> '',
            'genre_tuteur'=> '',
            'adresse_tuteur'=> '',
            'telephone_tuteur'=> '',
            'date_naissance_tuteur'=> '',
            'lieu_naissance_tuteur'=> '',
            'nationalite_tuteur'=> '',
            'mail_tuteur'=> '',

            'nom_eleve'=> '',
            'prenom_eleve'=> '',
            'genre_eleve'=> '',
            'adresse_eleve'=> '',
            'telephone_eleve'=> '',
            'date_naissance_eleve'=> '',
            'lieu_naissance_eleve'=> '',
            'nationalite_eleve'=> '',
            'mail_eleve'=> '',

            'contact_urgence1'=> '',
            'contact_urgence2'=> '',

        ];
    }
}
