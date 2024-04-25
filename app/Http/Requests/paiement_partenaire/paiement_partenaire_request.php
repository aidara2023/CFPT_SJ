<?php

namespace App\Http\Requests\paiement_partenaire;

use Illuminate\Foundation\Http\FormRequest;

class paiement_partenaire_request extends FormRequest
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
        'id_facture' => 'required',
        'date_paiement' => 'required',
        'mode_paiement' => 'required',
        'montant_payer' => ''
        ];
    }
}
