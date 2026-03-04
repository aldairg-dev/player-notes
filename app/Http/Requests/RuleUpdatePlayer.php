<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleUpdatePlayer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('update player') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'playerFullName' => 'required|string|max:255',
            'playerUsername' => 'required|string|max:255|unique:players,username,' . $this->player->id,
            'playerEmail' => 'required|email|unique:players,email,' . $this->player->id,
            'playerTypeId' => 'required|exists:player_types,id',
            'playerIdNumber' => 'required|string|unique:players,id_number,' . $this->player->id,
        ];
    }

    public function messages(): array
    {
        return [
            'playerFullName.required' => 'El nombre completo es obligatorio.',
            'playerUsername.required' => 'El nombre de usuario es obligatorio.',
            'playerUsername.unique' => 'Este nombre de usuario ya está en uso.',
            'playerEmail.required' => 'El correo electrónico es obligatorio.',
            'playerEmail.email' => 'Ingresa un correo electrónico válido.',
            'playerEmail.unique' => 'Este correo electrónico ya está registrado.',
            'playerTypeId.required'  => 'El tipo de identificación es obligatorio.',
            'playerIdNumber.required' => 'El número de identificación es obligatorio.',
        ];
    }
}
