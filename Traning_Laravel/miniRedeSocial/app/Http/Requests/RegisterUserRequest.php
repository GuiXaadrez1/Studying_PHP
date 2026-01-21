<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  Essa class é usada para validar os dados enviados em uma requisição HTTP
 * Ou seja, customizamos as regras de validação para o registro de um usuário
 *  na aplicação. Assim, garantimos que os dados recebidos estão corretos
 *  e seguem os padrões esperados antes de serem processados ou armazenados.
 */

class RegisterUserRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {   

        // return false; // padrão gerado pelo artisan

        // retornando true para realizar testes
        return true;
    }

    /**
     * Obtém as regras de validação que se aplicam à requisição.
     * basicamente usa o nosso Validator do Laravel
     * de forma automatica para validar os dados
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'username'=>'required|string|max:50|unique:users',
            'password'=>'required|string|min:8',
            //'password'=>'required|string|min:8|confirmed', // esse vai procurar o "campo password_confimed"
        ];
    }

    // Mensagens retornadas caso a validação venha a falhar
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',


            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail precisa ser um endereço válido.',
            'email.unique' => 'Este e-mail já está em uso.',


            'username.required' => 'O nome de usuário é obrigatório.',
            'username.unique' => 'Este nome de usuário já está em uso.',


            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 7 caracteres.',
        ];
    }
}
