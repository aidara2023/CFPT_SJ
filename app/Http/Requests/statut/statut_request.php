<?php

namespace App\Http\Requests\statut;

use Illuminate\Foundation\Http\FormRequest;

class statut_request extends FormRequest
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
    public function rules()
{
    return [
        'intitule' => 'required|string|max:255',
    ];
}
}
