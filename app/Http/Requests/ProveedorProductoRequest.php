<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorProductoRequest extends FormRequest
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
            'nombre' => ['string', 'required', 'min:3', 'max:50'],
            'descripcion' => ['string', 'required', 'min:3', 'max:255'],
            'direccion' => ['string', 'required', 'min:3', 'max:255'],
            'telefono' => ['string', 'required', 'min:3', 'max:20'],
            'correo' => ['email', 'nullable']
        ];
    }
}
