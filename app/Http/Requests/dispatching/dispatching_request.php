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
            'quantite' => 'required|integer|min:1',
            'id_departement' => 'required|exists:departements,id',
            'id_salle' => 'required|exists:salles,id',
            'id_materiel' => 'required|exists:materiels,id',
        ];
    }
}
