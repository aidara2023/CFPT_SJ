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
            'Nom'=>'required',
            'Prénom'=>'required',
            'Genre'=>'required',
            'Adresse'=>'required',
            'Email'=>'required',
            'Telephone'=>'required',
            'Mdp'=>'required',
            'date_naissance'=>'required',
            'Lieu_naissance'=>'required',
            'Nationalité'=>'required',
            'Photo'=>'required',
            'id_role'=>'required',
            'id_service'=>'required'
        ];
    }
}
