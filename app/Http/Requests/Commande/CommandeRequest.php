<?php

namespace App\Http\Requests\Commande;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Si c'est une création (POST)
        if ($this->isMethod('post')) {
            return [
                'id_demande' => 'required|array',
               
                'statut' => 'required|in:envoyé,livré,non livré',
            ];
        }
        
        // Si c'est une mise à jour (PUT/PATCH)
        return [
            
            'statut' => 'required|in:envoyé,livré,non livré',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('id_demande')) {
            $this->merge([
                'id_demande' => is_string($this->id_demande) 
                    ? json_decode($this->id_demande, true) 
                    : $this->id_demande
            ]);
        }
    }

    public function messages()
    {
        return [
            'id_demande.required' => 'Les demandes sont requises',
            'id_demande.array' => 'Les demandes doivent être un tableau',
            'statut.required' => 'Le statut est requis',
            'statut.in' => 'Le statut doit être envoyé, livré ou non livré'
        ];
    }
}