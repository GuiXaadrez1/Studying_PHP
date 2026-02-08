<?php

namespace App\Http\Controllers;

use App\Service\Categories\CategoryProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{

    private CategoryProductService $categoryProductService;
    
    public function __construct(CategoryProductService $service){
        $this->categoryProductService = $service;
    }

    public function index(){
        $data = $this->categoryProductService->listAllCategory();
        return response()->json($data,200);
    }

    public function show($id){
        
        $data = $this->categoryProductService->printCategoryActivy($id);
        
        return $data;
    }

    public function store(Request $request){

        //Pegando o id do usuario mapeado pelo sanctum no token 
        $idadmin = $request->user()->idadmin;

        $rules = [
            'nome' => 'required|string|max:255',
        ];

        $messages = [
            'nome.required' => 'Para inserir uma nova categoria é necessário passa o nome.',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        /**
         * Lembre-se:
         * O erro 422 (Unprocessable Entity) é um código de status HTTP que indica 
         * que o servidor entendeu a requisição, a sintaxe está correta, mas não 
         * conseguiu processar os dados por problemas semânticos ou de validação
         */

        // pegando os dados valdiados
        $data = $validator->validated();
        
        $registered = $this->categoryProductService->register($idadmin,$data);

        if(!$registered){
            return response()->json([
                'message' => 'Nao foi possivel inserir uma nova categoria',
                'data' => $data,
            ], 500);
        };

        return response()->json([
            'message' => 'Categoria de produto cadastrada com sucesso!',
        ], 201);

    }

    /**
     * Atualiza os dados da categoria pelo id passado na url do navegador
     */
    public function update(int $id, Request $request){

        // fazendo a concatenação do id passado pela URL 
        // com os dados passados pelo corpo do JSON (Body) na requisição  
        $inputs = array_merge($request->all(), ['idcategory' => $id]);

        //dd($inputs);

        $rules = [
            'nome' => 'required|string|max:255',
        ];

        $messages = [
            'nome.required' => 'O nome deve ser passado para realizar a atualização',
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

        // validando se a categoria já foi deletada lógicamente.
        if ($this->categoryProductService->notExistCategory($id)){
            return response()->json([
                'message' => 'Não é possível atualizar categorias deletadas!'
            ],422); 
        }

        $updated = $this->categoryProductService->categoryUpdate($id,$data);

        if(!$updated){
            return response()->json([
                'message' => 'Nao foi possivel atualizar as infomacoes da categoria',
                'data' => $data,
            ], 400);
        };

        return response()->json([
            'message' => 'Informacoes atualizadas com sucesso!',
        ], 200);
    }

    /**
     * Rescebe o id pela URL e nao pelo corpo da Requisição
     */
    public function destroy($id){
                    
        // Encontra um registro da categoria
        $category = $this->categoryProductService->getCategory($id);

        //dd($admin);

        if (!$category) {
            return response()->json(['message' => 'Registro não encontrado ou ou nao existe!'], 404);
        }

        if ($this->categoryProductService->notExistCategory($id)) {
            return response()->json(['message' => 'Esta categoria já foi deletada'], 422);
        }

        // Passamos apenas o ID. A Service e o Repository cuidam do resto.
        $deleted = $this->categoryProductService->softDelete($id);
        
        if(!$deleted){
            return response()->json(['message' => 'Não foi possível deletar a categoria!'], 400);            
        }

        return response()->json(['message' => ' Categoria de produto deletada sucesso!'], 200);   
    }

}
