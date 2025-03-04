<?php

namespace App\Http\Requests\SecteurActivite;

use Illuminate\Foundation\Http\FormRequest;

class SecteurActiviteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}