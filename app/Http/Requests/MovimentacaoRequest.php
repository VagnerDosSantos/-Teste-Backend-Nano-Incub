<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class MovimentacaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_movimentacao' => 'required|in:entrada,saida',
            'valor' => 'required',
            'observacao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tipo_movimentacao.required' => 'Este é um campo obrigatório',
            'tipo_movimentacao.in' => 'Os valores permitidos para este campo são "Entrada" ou "Saída"',
            'valor.required' => 'Este é um campo obrigatório',
            'observacao.required' => 'Este é um campo obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
