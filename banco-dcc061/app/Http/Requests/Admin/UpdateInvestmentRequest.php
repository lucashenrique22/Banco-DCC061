<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvestmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'term_months' => 'required|integer|min:1',
            'minimum_value' => 'required|numeric|min:0',
            'profitability' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do investimento é obrigatório.',
            'type.required' => 'O tipo de investimento é obrigatório.',
            'term_months.required' => 'O prazo em meses é obrigatório.',
            'term_months.integer' => 'O prazo em meses deve ser um número inteiro.',
            'term_months.min' => 'O prazo em meses deve ser no mínimo 1.',
            'minimum_value.required' => 'O valor mínimo é obrigatório.',
            'minimum_value.numeric' => 'O valor mínimo deve ser um número.',
            'minimum_value.min' => 'O valor mínimo deve ser no mínimo 0.',
            'profitability.required' => 'A rentabilidade é obrigatória.',
            'profitability.numeric' => 'A rentabilidade deve ser um número.',
            'profitability.min' => 'A rentabilidade deve ser no mínimo 0.',
        ];
    }
}
