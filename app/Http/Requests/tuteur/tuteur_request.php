<?php

namespace App\Http\Requests\tuteur;

use Illuminate\Foundation\Http\FormRequest;

class tuteur_request extends FormRequest
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
            'nom_tuteur' =>  'required',
            'prenom_tuteur' =>  'required',
            'genre_tuteur' =>  'required',
            'adresse_tuteur' =>  'required',
            'email_tuteur'=>  'required',
            'telephone_tuteur'=> 'required',
            'password_tuteur'=> '',
            'date_naissance_tuteur'=> 'required',
            'lieu_naissance_tuteur'=> 'required',
            'nationalite_tuteur'=> 'required',
            'photo'=> '',
            'id_user'=>'',
        ];
    }
}
