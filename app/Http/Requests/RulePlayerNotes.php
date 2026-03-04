<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RulePlayerNotes extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('add player notes') ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'noteContent' => ['required', 'string', 'max:1000'],
            'playerId' => ['required', 'integer', 'exists:players,id'],
        ];
    }
}
