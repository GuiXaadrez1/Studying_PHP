<?php

namespace App\Http\Controllers;

# use Illuminate\Http\Request;

class UserController extends Controller
{
    
    private function getUserInfo():array{
        return [];
    }

    protected function apiResponseUpdateData(mixed $data){
        try{
            return response($status=201)->json([
                'message' => 'User created successfully',
                'data'=>$data
            ]);
        } catch (\Exception $e) {
            // Retorna um JSON com a mensagem real do erro e o código 500
            return response()->json([
                'error' => 'Erro interno no servidor',
                'details' => $e->getMessage() // Pega a mensagem da exceção
            ], 500);
        }
    }

    public function index(){
        return $this->apiResponseGetAllData($this->getUserInfo());
    }
}
