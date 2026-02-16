<?php

namespace App\Service\Login_Logout;

// para trabalhar com autentificação de usuários
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // método específico para login de administrador
use App\Models\Vendedor; // método específico para login de vendedor
use Illuminate\Support\Facades\Hash; // validaocao de senhas hashadas no formato bycrypt

use Illuminate\Http\Request;

class LoginService
{
    /**
     * Create a new class instance.
     */    
    public function __construct(){}

    // Aqui é composição pura
    /*public function login(array $credentials){
        
        // finja que é uma repository bem aqui
        $admin = Admin::where('email', $credentials['email'])->first();

        //dd($admin->toArray());

        if (!$admin) {
            //return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json(['error' => 'Registro nao encontrado'], 404);
        }

        $senhaDigitada = $credentials['senha'];
        
        //dd($senhaDigitada);

        $senhaBanco = $admin->senha;

        //dd($senhaBanco);

        // 👉 SE FOR MD5
        if (strlen($senhaBanco) === 32) {

            if (md5($senhaDigitada) !== $senhaBanco) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Migra automaticamente para bcrypt
            $admin->senha = Hash::make($senhaDigitada);
            $admin->save();
        }
        // 👉 SE FOR BCRYPT
        else {
            if (!Hash::check($senhaDigitada, $senhaBanco)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        // Login manual no guard admin
        //Auth::guard('admin')->login($admin);

        //dd(Auth::guard('admin')->login($admin));

        // Geração do token (Sanctum)
        try {
            $token = $admin->createToken('admin_token')->plainTextToken;
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar token',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }

        //dd($token);

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);

    }*/

    public function loginAdm(array $credentials)
    {   
        // O administrador deve esta ativo e devidamente cadastrado para realizar o login
        // caso ao constrario, o sistema deve retornar um erro de "registro nao encontrado" ou "nao autorizado"
        $admin = Admin::where('email', $credentials['email'])
            ->where('statusdelete', false)
            ->first();

        // Se nao existir o administrador ou estiver inativo, retorna erro de "registro nao encontrado"
        if (!$admin) {
            return response()->json(['error' => 'Registro nao encontrado'], 404);   
        }

        // Senha errada! 
        if (!Hash::check($credentials['senha'], $admin->senha)) {
            return response()->json(['error' => 'Senha incorreta'], 401);
        }

        try {
            // Antes de criar, garantimos que o ID está no formato correto
            // $id = (int) $admin->idadmin; 
            
            // Criamos o token
            $tokenResult = $admin->createToken('admin_token');
            
            return response()->json([
                'access_token' => $tokenResult->plainTextToken,
                'token_type'   => 'Bearer',
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            // Se o erro for de banco (Postgres), ele vai cair aqui
            return response()->json([
                'error' => 'Erro de Banco de Dados',
                'sql_message' => $e->getMessage(), // Isso vai te dizer se falta a coluna 'password' ou 'id'
                'query' => $e->getSql()
            ], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function logoutAdm(Request $request)
    {   

        // Recupera o admin autenticado pelo token
        // $admin = $request->user($guard = 'admin'); 

        $admin = $request->user('admin');

        // O código acima se equivale  =>  auth('admin')->user();

        if ($admin) {
            // Deleta apenas o token que está sendo usado nesta sessão
            $admin->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout realizado com sucesso']);
        }
        return response()->json(['error' => 'Não autorizado'], 401);
    }

    // ------------------ CRIANDO LÓGICA DE LOGIN DO VENDEDOR ------------------

    public function loginVendedor(array $credentials){

        // Procurar pelo funcionario com o email fornecido e que esteja ativo (statusdelete = false)
        $vedendor = Vendedor::where('email', $credentials['email'])
            ->where('statusdelete', false)
            ->first();

        if (!$vedendor) {
            return response()->json(['error' => 'Vendedor não encontrado'], 404);
        }

        // se o código de funcionário estiver errado, retornar "código do funcionário incorreto"
        if ( (int) $credentials['senha'] !== $vedendor->codfun) {
            return response()->json(['error' => 'Código do Funcionário incorreto!'], 401);
        }

        try {
            $tokenResult = $vedendor->createToken('vendedor_token');
            
            return response()->json([
                'access_token' => $tokenResult->plainTextToken,
                'token_type'   => 'Bearer',
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logoutVendedor(Request $request)
    {   
        $vendedor = $request->user('vendedor');
        
        dd("Cehgou até aqui!", $vendedor);

        if ($vendedor) {
            $vendedor->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout realizado com sucesso']);
        }
        return response()->json(['error' => 'Não autorizado'], 401);
    }

}
