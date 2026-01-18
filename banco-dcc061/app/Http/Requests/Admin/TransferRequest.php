<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
            'destination_account' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:1'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'destination_account.required' => 'A conta de destino é obrigatória.',
            'amount.required' => 'O valor da transferência é obrigatório.',
            'amount.numeric' => 'O valor da transferência deve ser numérico.',
            'amount.min' => 'O valor da transferência deve ser pelo menos 1.',
            'password.required' => 'A senha é obrigatória.',
        ];
    }
}
