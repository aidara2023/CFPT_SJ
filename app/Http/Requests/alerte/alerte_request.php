<?php

namespace App\Http\Requests\alerte;

use Illuminate\Foundation\Http\FormRequest;

class alerte_request extends FormRequest
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
            'titre' => 'required',
            'message' => 'required',
            'statut' => 'required',
            'id_user' => ''
        ];
    }
}
