<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// vamos passar a instância de service para controller...
// via DI, indejão de depedência

use App\Service\Admin\AdminService;

class AdminController extends Controller
{   

    // criando um atributo para conter a intância de repository
    private AdminService $admService;

    public function __construct(AdminService $admService)
    {
        $this->admService = $admService;
    }

    public function index(Request $request){

        $data = $this->admService->getActivyAdmins();

        if(!$data){
            return response()->json(["message" => "Não possui 
            registros de administradores"],404);
        };

        return response()->json($data,200);
    }

    public function show(int $id,Request $request){

        //dd($request->user());

        // Obtém o ID diretamente do token autenticado
        // dd($id = $request->user()->idadmin);

        // Obtém o objeto Admin completo
        //dd($admin = $request->user());

        $data = $this->admService->getActivyAdmin($id);

        // validando se os dados esta vazios
        if(!$data || count(get_object_vars($data)) === 0){
            return response()->json([
                "message" => "Nao existe registros deste administrador",
                "status" => 404,
            ]);
        }

        return response()->json($data,200);
    }

    public function store(Request $request){

        //Pegando o id do usuario mapeado pelo sanctum no token 
        $idadminfk = $request->user()->idadmin;

        $rules = [
            'codadmin' => 'required|integer|unique:administrador,codadmin',
            'nome' => 'required|string|max:255',
            'email' =>'required|email|max:255|unique:administrador,email',
            'senha' =>'required|string|min:6',
        ];

        $messages = [
            'codadmin.unique' => 'Este codigo de administrador já está em uso.',
            'email.unique' => 'Este e-mail já está em uso.',
            'senha.min'    => 'A senha deve ter no mínimo 6 caracteres.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // pegando os dados valdiados
        $data = $validator->validated();

        $registered = $this->admService->register($data,$idadminfk);

        if(!$registered){
            return response()->json([
                'message' => 'Nao foi possivel inserir um novo administrador',
                'data' => $data,
            ], 500);
        };

        return response()->json([
            'message' => 'Novo administrador criado com sucesso!',
        ], 201);
    }


    public function update(int $id, Request $request){

        //Pegando o id do usuario mapeado pelo sanctum no token 
        // admin que esta fazendo a modificação
        //$authAdmin = $request->user()->idadmin;

        // Criamos um array local unindo o ID da URL com o que veio no JSON
        // Se o JSON estiver vazio, ele apenas valida o ID.
        $inputs = array_merge($request->all(), ['id' => $id]);

        //dd($inputs);

        $rules = [
            'id' => 'required|integer|exists:administrador,idadmin',
            'nome' => 'nullable|string|max:255',
            // O pulo do gato: unique:tabela,coluna,id_para_ignorar,nome_da_pk_no_banco
            'email' => 'nullable|email|max:255|unique:administrador,email,' . $id . ',idadmin',
            'senha' => 'nullable|string|min:6',
        ];

        $messages = [
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'id.exists' => 'O administrador informado não existe no banco.',
        ];

        $validator = Validator::make($inputs,$rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // pegando os dados valdiados
        $data = $validator->validated();

        //dd($data);

        if ($this->admService->notExistAdm($data['id'])){
            return response()->json([
                'message' => 'Nao é possível atualizar um administrador deletado!'
            ],422); 
        }

        $updated = $this->admService->adminUptade($data['id'],$data);

        if(!$updated){
            return response()->json([
                'message' => 'Nao foi possivel atualizar as infomacoes do administrador',
                'data' => $data,
            ], 400);
        };

        return response()->json([
            'message' => 'Informacoes atualizadas com sucesso!',
        ], 200);
    }

    // Método de delecao lógica
    /*public function destroy(int $id, Request $request){
       
        $inputs = array_merge($request->all(), ['id' => $id]);
    
        $rules = ['deletado' => 'required|boolean|in:true,1'];

            //A Regra do in:true,1
            //No seu Validator, você usou: 'deletado' => 'required|boolean|in:true,1'.
            //Isso é perfeito para o seu objetivo de "só ida". 
            //Ele garante que ninguém consiga enviar false para tentar burlar o 
            //sistema e recuperar um registro por essa rota.

        $validator = Validator::make($inputs, $rules);

        // Verificamos se o registro existe fisicamente (Independente de status)
        // Isso evita o erro de tentar checar status em algo que não existe
        $admin = $this->admService->getAdmin($id);
        if (!$admin) {
            return response()->json(['message' => 'Registro não encontrado no sistema.'], 404);
        }

        // Verificamos se ele JÁ está deletado (Usando o seu service/repository)
        if ($this->admService->notExistAdm($id)) {
            return response()->json(['message' => 'Este administrador já foi deletado anteriormente!'], 422);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $deleted = $this->admService->softDelete($id, $validator->validated());

        if (!$deleted) {
            return response()->json(['message' => 'Não foi possível completar a exclusão.'], 500);
        }

        return response()->json(['message' => 'Administrador deletado com sucesso!'], 200);

    }*/


    // metodo http puramente de cao, nada de request
    public function destroy(int $id) {
        
        // O ID já vem da URL, não precisamos de merge ou validator de body
        $admin = $this->admService->getAdmin($id);

        //dd($admin);

        if (!$admin) {
            return response()->json(['message' => 'Registro não encontrado ou ou nao existe!'], 404);
        }

        if ($this->admService->notExistAdm($id)) {
            return response()->json(['message' => 'Este administrador já foi deletado'], 422);
        }

        // Passamos apenas o ID. A Service e o Repository cuidam do resto.
        $deleted = $this->admService->softDelete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Não foi possível completar a exclusão.'], 500);
        }
        
        return response()->json(['message' => 'Administrador deletado com sucesso!'], 200);   
    }
}
