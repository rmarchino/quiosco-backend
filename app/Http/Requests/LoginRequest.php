<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email es obligatoria',
            'email.email' => 'El email no es válido',
            'email.exists' => 'Esta cuenta no existe',
            'password.required' => 'El Password es obligatorio',
        ];
    }
}
