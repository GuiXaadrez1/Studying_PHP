<?php

namespace App\Http\Controllers;

// para trabalhar com requisições http
use Illuminate\Http\Request;

use App\Service\Login_Logout\LoginService;
// usando service de fazer login

class LoginController extends Controller
{   

    // IoC container
    private LoginService $login;


    public function __construct(LoginService $login){
        $this->login = $login;
    }

    public function store(Request $request)
    {   

        // validando o valor de isVendedor, para garantir que seja um booleano válido
        if((int)$request->input('isVendedor') > 1){
            return response()->json(['error' => 'Não foi possível realizar o login.'], 400);
        }

        // Obtendo dados da requisicao via Query String da Url
        $isVendedor = (bool)$request->input('isVendedor');

        // Se for login de vendedor, chama o método específico para login de vedendores
        if ($isVendedor) {
            return $this->login->loginVendedor(
                $request->only('email', 'senha')
            );
        }

        // Caso contrário, é login de admin
        return $this->login->loginAdm(
            $request->only('email', 'senha'),
            $isVendedor
        );
    }

    public function logout(Request $request)
    {   

        // dd((int)$request->input('isVendedor'));

        // validando o valor de isVendedor, para garantir que seja um booleano válido
        if((int)$request->input('isVendedor') > 1){
            return response()->json(['error' => 'Não foi possível realizar o logout.'], 400);
        }
        
        // Obtendo dados da requisicao via Query String da Url
        $isVendedor = (bool)$request->input('isVendedor');

        // Se for logout de vendedor, chama o método específico para logout de vedendores
        if ($isVendedor) {
            return $this->login->logoutVendedor($request);
        }

        // Caso contrário, é logout de admin
        return $this->login->logoutAdm($request);
    }
}
