<?php

namespace App\Http\Requests\retard;

use Illuminate\Foundation\Http\FormRequest;

class retard_request extends FormRequest
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
            'date'=>'required',
            'heure'=>'required',
            'id_eleve'=>'required',
            'id_cour'=>'required'
            
        ];
    }
}