<?php

namespace App\Http\Requests\assister;

use Illuminate\Foundation\Http\FormRequest;

class assister_request extends FormRequest
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
            'presence'=>'required',
            'id_cour'=>'required',
            'id_eleve'=>'required',
        ];
    }
}
