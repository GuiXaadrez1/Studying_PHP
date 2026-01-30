<?php

namespace App\Service\Login_Logout;

// para trabalhar com autentificação de usuários
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

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

    public function login(array $credentials)
    {
        $admin = Admin::where('email', $credentials['email'])->first();

        // ... sua lógica de conferência de senha ...

        try {
            // Antes de criar, garantimos que o ID está no formato correto
            $id = (int) $admin->idadmin; 
            
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
    
    public function logout(Request $request)
    {
        // Recupera o admin autenticado pelo token
        $admin = $request->user(); 

        if ($admin) {
            // Deleta apenas o token que está sendo usado nesta sessão
            $admin->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout realizado com sucesso']);
        }

        return response()->json(['error' => 'Não autorizado'], 401);
    }
}
