<?php

namespace App\Http\Requests\note;

use Illuminate\Foundation\Http\FormRequest;

class note_request extends FormRequest
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
            'id_eleve'=>'required',
            'id_formateur'=>'required',
            'id_type_evaluation'=>'required',
           'id_annee_academique'=>'required',
            'id_semestre'=>'required',
            'id_matiere'=>'required',
            'Note_obtenue'=>'required',
            'date_enregistrer'=>'required',
            'Appreciation'=>'required',
            'Observation'=>'required'
        ];
    }
}
