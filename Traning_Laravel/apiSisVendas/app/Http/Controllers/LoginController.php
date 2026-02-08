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
        return $this->login->login(
            $request->only('email', 'senha')
        );
    }

    public function logout(Request $request)
    {
        return $this->login->logout($request);
    }
}
