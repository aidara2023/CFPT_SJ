<?php

namespace App\Http\Requests\caissier;

use Illuminate\Foundation\Http\FormRequest;

class caissier_request extends FormRequest
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
            'nom_caissier'=>'required',
            'prenom_caissier'=>'required',
            'genre_caissier'=>'required',
            'adresse_caissier'=>'required',
            'email_caissier'=>'required',
            'telephone_caissier'=>'required',
            'password_caissier'=>'',
            'date_naissance_caissier'=>'required',
            'lieu_naissance_caissier'=>'required',
            'nationalite_caissier'=>'required',
            'photo'=>'required',
            'id_role'=>'required',
            'id_user'=>'',
            'id_service'=>'required'
        ];
    }
}
