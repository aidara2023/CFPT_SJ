<?php

namespace App\Http\Requests\personnel_admin_appui;

use Illuminate\Foundation\Http\FormRequest;

class personnel_admin_appui_request extends FormRequest
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
            'id_user'=>'required',
            'id_service'=>'required',
            'type_personnel'=>'required'
        ];
    }
}
