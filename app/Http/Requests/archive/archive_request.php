<?php

namespace App\Http\Requests\archive;

use Illuminate\Foundation\Http\FormRequest;

class archive_request extends FormRequest
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
            'titre'=>'required',
            'type'=>'required',
            'statut'=>'required',
            'date_destruction'=>'required',
            'contenu'=>'required',
            'id_departement'=>'required',
            'id_service'=>'required'
        ];
    }
}
