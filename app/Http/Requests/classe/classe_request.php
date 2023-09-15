<?php

namespace App\Http\Requests\classe;

use Illuminate\Foundation\Http\FormRequest;

class classe_request extends FormRequest
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
            'type_classe'=>'required',
            'nom_classe'=>'required',
            'niveau'=>'required',
            'id_type_formation'=>'required',
            'id_unite_de_formation'=>'required'
        ];
    }
}
