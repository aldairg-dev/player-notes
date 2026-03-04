<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleCreatePlayer extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create player') ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'newPlayerFullName' => ['required', 'string', 'max:200'],
            'newPlayerUsername' => ['required', 'string', 'max:50', 'unique:players,username'],
            'newPlayerEmail'   => ['required', 'email', 'max:255', 'unique:players,email'],
            'newPlayerTypeId'  => ['required', 'string', 'max:50'],
            'newPlayerIdNumber' => ['required', 'string', 'max:50', 'unique:players,identification_number'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'newPlayerFullName.required' => 'El nombre completo es obligatorio.',
            'newPlayerUsername.required'  => 'El nombre de usuario es obligatorio.',
            'newPlayerUsername.unique'    => 'Este nombre de usuario ya está en uso.',
            'newPlayerEmail.required'    => 'El correo electrónico es obligatorio.',
            'newPlayerEmail.email'       => 'Ingresa un correo electrónico válido.',
            'newPlayerEmail.unique'      => 'Este correo electrónico ya está registrado.',
            'newPlayerTypeId.required'   => 'El tipo de identificación es obligatorio.',
            'newPlayerIdNumber.required' => 'El número de identificación es obligatorio.',
            'newPlayerIdNumber.unique'   => 'Este número de identificación ya está registrado.',
        ];
    }
}
