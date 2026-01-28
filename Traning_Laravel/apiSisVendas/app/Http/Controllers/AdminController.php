<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// vamos passar a instância de repositories para controller...
// via DI, indejão de depedência

use App\Repositories\Contracts\AdminInterface;

class AdminController extends Controller
{   

    // criando um atributo para conter a intância de repository
    private AdminInterface $AdmRepository;

    public function __construct(AdminInterface $AdmRepository)
    {
        $this->AdmRepository = $AdmRepository;
    }

    
    public function index(Request $request){

        $data = $this->AdmRepository->getAllAdmin();

        if(!$data){
            return response()->json(["message" => "Não possui 
            registros de administradores"],404);
        };

        return response()->json($data,200);
    }

    public function show(int $id){
        
        $data = $this->AdmRepository->getAdmin($id);

        // validando se os dados esta vazios
        if(!$data || count(get_object_vars($data)) === 0){
            return response()->json([
                "message" => "Nao existe registros deste administrador",
                "status" => 404,
            ]);
        }

        return response()->json($data,200);
    }

}
