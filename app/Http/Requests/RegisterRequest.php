<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'in:admin,tecnico,usuario',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'El nombre es obligatorio',
            'email.required'    => 'El email es obligatorio',
            'email.unique'      => 'Este email ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min'      => 'La contraseña debe tener mínimo 6 caracteres',
        ];
    }
}