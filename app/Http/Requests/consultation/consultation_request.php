<?php

namespace App\Http\Requests\consultation;

use Illuminate\Foundation\Http\FormRequest;

class consultation_request extends FormRequest
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
            'id_consultation' => 'required',
            'id_user' => 'required',
            'id_infirmier' => 'required',
            'id_dossier_medical' => 'required',
            
        ];
    }
}
