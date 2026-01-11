<?php

namespace App\Http\Controllers;

/*
    Apos o comando de criacao de controllers 
    o laravel cria um estrutura automaticamente
    ao qual temos uma class pai Controller abastratar para usarmos 
    polimofirmos por subescrita overide.
*/

use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

abstract class Controller
{
    /*
        Criando uma método abastrato para o mesmo ser reutilizado em outras classes
    */

    // Método comum para todas as Apis
    protected function apiResponseGetAllData(mixed $data){
        try {

            if ($data->isEmpty()){
                return response()->json(["message"=>"Nem um game cadastrado"], 404);
            }
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
    
        }    
    }

    protected function apiResponseGetGameData(mixed $data){
        try {
           
            if (is_null($data)) {
                return response()->json(["message" => "Registro inexistente"], 404);
            }
            return response()->json($data, 200);
        
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
    
        }    
    }

    # definindo método abstrato para as subclass implementar da forma como quiser
    abstract protected function apiResponseCreateData(mixed $request);

    abstract protected function apiResponseUpdateData(mixed $request,int $id);

    abstract protected function apiResponseDeleteData(int $id);
}

