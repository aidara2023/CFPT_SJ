<?php

namespace App\Http\Requests\editeur;

use Illuminate\Foundation\Http\FormRequest;

class editeur_request extends FormRequest
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
            'id',
            'nom_editeur'=>'required'
        
        ];
    }
}
