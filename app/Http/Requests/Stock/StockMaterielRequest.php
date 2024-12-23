<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class StockMaterielRequest extends FormRequest
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
            'id_type_materiel' => 'required|exists:type_materiels,id',
        ];
    }
}