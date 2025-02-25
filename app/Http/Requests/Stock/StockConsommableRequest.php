<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class StockConsommableRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'libelle' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'quantite_disponible' => 'required|integer|min:0',
        ];
    }
}