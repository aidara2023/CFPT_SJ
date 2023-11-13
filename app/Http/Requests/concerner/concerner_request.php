<?php

namespace App\Http\Requests\concerner;

use Illuminate\Foundation\Http\FormRequest;

class concerner_request extends FormRequest
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

                'id_annee_academique'=>'required',
                'id_paiement'=>'',
                'id_mois'=>'required',
                'statut'=>''

            ];  
    }
}
