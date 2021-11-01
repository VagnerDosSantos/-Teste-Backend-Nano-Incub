<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class FuncionarioRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'nome_completo' => 'required|string|min:5|max:255',
            'login' => 'required|string|min:5|max:20|unique:funcionarios,login,' . $request->id . '|unique:administradores,login,' . $request->id,
            'senha' => [
                Rule::requiredIf(function () use ($request) {
                    return (empty($request->id));
                }),
                'same:confirmar_senha'
            ],
            'confirmar_senha' => [
                Rule::requiredIf(function () use ($request) {
                    return (empty($request->id));
                }),
            ]
        ];
    }
    
    public function messages()
    {
        return [
            'nome_completo.required' => 'O nome completo é um campo obrigatório!',
            'nome_completo.min' => 'Este campo precisa conter pelo menos 5 caracteres!',
            'login.required' => 'O nome de usuário é um campo obrigatório!',
            'login.unique' => 'Este nome de usuário já está em uso!',
            'login.min' => 'O nome de usuário precisa conter pelo menos 5 caracteres!',
            'senha.required' => 'O campo senha é obrigatório!',
            'senha.same' => 'A senha informada não corresponde ao campo de confirmação!',
            'senha.confirmar_senha' => 'O campo confirmar senha é obrigatório'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
