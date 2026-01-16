<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->cpf),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'cpf' => 'required|string|size:11|unique:users,cpf,' . $this->route('user')->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:administrador,usuario',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.unique' => 'Este CPF já está em uso por outro usuário.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
        ];
    }
}
    