<?php

namespace App\Http\Requests\cahier_de_texte;

use Illuminate\Foundation\Http\FormRequest;

class cahier_de_texte extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'intitule'=>'required',
            'contenu'=>'required',
            'id_cour'=>'required'
        ];
    }
}
