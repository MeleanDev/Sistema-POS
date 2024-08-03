<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaDatoRequest extends FormRequest
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
            'nempresa' => ['required','string','min:4', 'max:255'],
            'rif' => ['required','string','min:5', 'max:50'],
            'rsocial' => ['required','string','min:4', 'max:255'],
            'correo' => ['required','email', 'max:255'],
            'telefono' => ['required','string','min:8', 'max:20'],
            'direccion' => ['required','string','min:5', 'max:255'],
            'pais' => ['required','string','min:3', 'max:50'],
            'estado' => ['required','string','min:3', 'max:50'],
            'ciudad' => ['required','string','min:3', 'max:50'],
            'cpostal' => ['required','string','min:3', 'max:20']
        ];
    }
}
