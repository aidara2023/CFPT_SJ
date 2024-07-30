<?php

namespace App\Http\Requests\emploi_du_temps;

use Illuminate\Foundation\Http\FormRequest;

class emploi_du_temps_request extends FormRequest
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
           'id_cour'=>'required',
           'id_salle'=>'required',
           'id_annee_academique'=>'required',
           'date_debut'=>'required',
           'date_fin'=>'required',
           'heure_debut'=>'required',
           'heure_fin'=>'required',
        ];
    }
}
