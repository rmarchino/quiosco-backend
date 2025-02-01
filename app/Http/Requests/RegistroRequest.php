<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordValidator;

class RegistroRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordValidator::min(8)->letters()->symbols()->numbers()
            ],
        ];
    }

    public function messages() {
        return [
            'name' => 'El campo nombre es requerido',
            'email.required' => 'El campo correo electrónico es requerido',
            'email.email' => 'El campo correo electrónico debe ser válido',
            'email.unique' => 'El correo electrónico ya está en uso',
            'password' => 'El password debe contener al menos 8 caracteres, un sínmbolo y un número',
        ];
    }
}
