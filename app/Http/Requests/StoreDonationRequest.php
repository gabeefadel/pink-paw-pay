<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonationRequest extends FormRequest
{

    public function authorize(): bool
    {

        return true;
    }

 
    public function rules(): array
    {
        return [
 
            'document' => ['required', 'string', 'min:11', 'max:14'], 
        
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            
            'card_number' => [
                'required_if:payment_method_id,2', 
                'nullable', 
                'string', 
                'regex:/^[0-9]{16}$/' 
            ],
            'card_cvv' => [
                'required_if:payment_method_id,2', 
                'nullable', 
                'string', 
                'min:3', 
                'max:4'
            ],
            'card_expiry' => [
                'required_if:payment_method_id,2', 
                'nullable', 
                'string', 
                'date_format:m/Y' 
            ],
            'card_holder_name' => [
                'required_if:payment_method_id,2', 
                'nullable', 
                'string', 
                'min:3'
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'payment_method_id.exists' => 'Método de pagamento inválido.',
            'card_number.required_if' => 'Para pagamentos com cartão, o número é obrigatório.',
            'card_expiry.date_format' => 'A validade deve estar no formato Mês/Ano (ex: 12/2030).',
        ];
    }
}