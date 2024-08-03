<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'nombre' => ['string', 'required', 'min:1', 'max:100'],
            'codigo' => ['string', 'required', 'min:1', 'max:100'],
            'proveedor' => ['required', 'string'],
            'categoria' => ['required', 'string'],
            'descripcion' => ['string', 'required', 'min:1', 'max:100'],
            'precio' => ['required', 'min:1'],
            'cantidad' => ['required', 'min:1'],
            'foto' => [
                'image',
                'nullable',
                'mimes:jpeg,png',
                'max:12288'
            ]
        ];
    }
}
