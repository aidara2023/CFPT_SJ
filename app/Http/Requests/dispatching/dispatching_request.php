<?php

namespace App\Http\Requests\dispatching;

use Illuminate\Foundation\Http\FormRequest;

class dispatching_request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_user' => 'nullable|exists:users,id', 
            'id_departement' => 'nullable|exists:departements,id',
            'id_salle' => 'required|exists:salles,id',
            'id_materiel' => 'required|exists:materiels,id',
            'id_consommable' => 'required',
            'id_commande' => 'required',
            'id_batiment' => 'required',
        ];
    }
}
