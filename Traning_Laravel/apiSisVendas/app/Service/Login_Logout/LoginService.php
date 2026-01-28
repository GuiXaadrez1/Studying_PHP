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
    public function login(array $credentials){
        
        // finja que é uma repository bem aqui
        $admin = Admin::where('email', $credentials['email'])->first();

        //dd($admin->toArray());

        if (!$admin) {
            //return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json(['error' => 'Registro nao encontrado'], 404);
        }

        $senhaDigitada = $credentials['senha'];
        $senhaBanco = $admin->senha;

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

        // Geração do token (Sanctum)
        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);

    }

    public function logout(Request $request)
    {
        $admin = $request->user();

        if (!$admin) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $admin->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }
}
