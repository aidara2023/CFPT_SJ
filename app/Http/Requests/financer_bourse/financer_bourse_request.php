<?php

namespace App\Http\Requests\financer_bourse;

use Illuminate\Foundation\Http\FormRequest;

class financer_bourse_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date'=>'',
           'montant'=>'',
          'id_eleve '=>'',
          'id_classe'=>'',
          'id_annee_academique'=>''
        ];
    }
}
