<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'callback' => ['nullable', 'boolean'],
            'agree' => ['accepted'],

            // Nur erforderlich, wenn kein Rückruf gewünscht ist
            'message' => $this->input('callback')
                ? ['nullable', 'string', 'max:2000']
                : ['required', 'string', 'max:2000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
