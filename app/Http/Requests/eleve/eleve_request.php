<?php

namespace App\Http\Requests\eleve;

use Illuminate\Foundation\Http\FormRequest;

class eleve_request extends FormRequest
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
            'nom_eleve'=>'required',
            'prenom_eleve'=>'required',
            'genre_eleve'=>'required',
            'adresse_eleve'=>'required',
            'email_tuteur'=>'',
            'telephone_eleve'=>'required',
            'password'=>'',
            'date_naissance_eleve'=>'required',
            'lieu_naissance_eleve'=>'required',
            'nationalite_eleve'=>'required',
            'nom_tuteur'=>'required',
            'prenom_tuteur'=>'required',
            'genre_tuteur'=>'required',
            'adresse_tuteur'=>'required',
            'email_tuteur'=>'',
            'telephone_tuteur'=>'required',
            'password'=>'',
            'date_naissance_tuteur'=>'required',
            'lieu_naissance_tuteur'=>'required',
            'nationalite_tuteur'=>'required',
            'photo'=>'required',
            'id_role'=>'',

            'id_user'=>'',
            'contact_urgence_1'=>'required',
            'contact_urgence_2'=>'required',
            'id_tuteur'=>''

        ];
    }
}
