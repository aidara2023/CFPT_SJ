<?php

namespace App\Http\Requests\bibliothecaire;

use Illuminate\Foundation\Http\FormRequest;

class bibliothecaire_request extends FormRequest
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
            'nom'=>'required',
            'prenom'=>'required',
            'genre'=>'required',
            'adresse'=>'required',
            'email'=>'',
            'telephone'=>'required',
            'password'=>'',
            'date_naissance'=>'required',
            'lieu_naissance'=>'required',
            'nationalite'=>'required',
            'photo'=>'',
            'id_role'=>'',
            'id_service'=>''
        ];
    }
}
