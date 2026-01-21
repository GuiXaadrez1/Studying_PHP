<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;

        return true;
    }
    
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:4|max:20',
            'password' => 'required|string|min:6|max:32',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'O nome de usuário é obrigatório.',
            'username.min' => 'O nome de usuário deve ter no mínimo :min caracteres.',
            'username.max' => 'O nome de usuário deve ter no máximo :max caracteres.',


            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
        ];
    }
}
