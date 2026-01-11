<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Request;

# Para importacao obrigatória para validacao de dados enviado pelo requests
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    
    
    private function getGameInfo($id){
        $game = new Games();

        $data = $game::find($id); 
        
        //dd(gettype($data));
        //dd($data);

        return $data;
    }

    private function getGamesAllInfo(){
        
        // aqui estamos fazendo a comunicacao ente controller e model

        // cria um objeto model 
        $games = new Games();

        // Busca todos os jogos do banco
        $data = $games::all();
        
        return $data;
    }
    
    /**
     * Funcao que retorna dados com base em uma requisicao http request
     * Usando uma funcao de ajuda da class pai
    */

    protected function apiResponseCreateData(mixed $data){
        try{
            
            $game = new Games();

            $game->name = $data['name'];
            $game->description = $data['description'];
            $game->thumb = $data['thumb'];
            $game->release_date = $data['release_date'];
            
            # Salva a modal dentro do banco de dados
            $game->save();
                
            return response()->json([
                'message' => 'Game created successfully',
                'data' => $data
            ], 201);

        } catch (\Exception $e) {
           
            // Retorna um JSON com a mensagem real do erro e o código 500
            return response()->json([
                'error' => 'Erro interno no servidor',
                'details' => $e->getMessage() // Pega a mensagem da exceção
            ], 500);
        }
    }

    protected function apiResponseUpdateData($data,$id){
        
        # Vamos encontrar o objeto
        $game = Games::find($id);
        
        // Verificação de segurança caso o ID não exista no banco
        if (!$game) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        // 2. Atualiza as propriedades na memória
        $game->name = $data['name'];
        $game->description = $data['description'];
        $game->thumb = $data['thumb'];
        $game->release_date = $data['release_date'];

        // O Laravel gerencia o updated_at automaticamente, 
        // mas se quiser forçar manualmente como fez:

        $game->updated_at = date('Y-m-d H:i:s'); # colocando a o data e hora atual
    
        // 3. PERSISTÊNCIA (atualiza os dados da modal no banco de dados)
        // O Eloquent ORM consegue gerenciar insercao e atualizacao de dados
        
        // Se o objeto foi criado agora (new Games()), o save() executa um INSERT.
        // Se o objeto veio do banco (Games::find($id)), o save() executa um UPDATE.

        $game->save();

        return response()->json([
            'message' => 'Jogo atualizado com sucesso!',
            'data' => $game
        ], 200); 
    
    }

    public function index(){
        return $this->apiResponseGetAllData($this->getGamesAllInfo());
    }


    public function show(int $id){

        # transforma o id passado via url em inteiro
        $idInt = (int) $id;

        return $this->apiResponseGetGameData($this->getGameInfo($idInt));
    
    }

    /**
     * Funcao que vamos utilizar para persistir, inserir um Game no banco de dados
     */
    public function store(Request $request){
        
        /**
         * O método validate do Request serve para aplicarmos uma filtragem
         * e um serie de roles(regras), mostrando se é obrigatório ou nao, tipo de dado, tamanho maximo
         */

        // Lembre-se que os dados enviados pela api devem ter o mesmo nomes dos atributos da tabela

        // $request->all(); -> retorna todos os dados enviados pelo usuario pelo navegador
        // nao é uma forma elegante de ser usado... por isso use o validate

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'thumb' =>'required|string|max:255',
            'release_date' =>'required|date',
        ]);

        # Essa bruxaria é a mágica do Eloquent ORM
        # Com ele podemos definir nome de colunas diretamente sem ter criado o atributo
        # na class Modal... 
        # isso de da porque:
        # Quando você faz $game->name = 'Valor', o Eloquent intercepta isso e guarda esse
        # valor dentro de um array interno chamado $attributes
        
        /*
            A relação é esta: O $fillable diz quais chaves desse array interno podem
            ser preenchidas de uma vez só (Mass Assignment). Mas individualmente, você
            pode acessar qualquer coluna da tabela como se fosse uma propriedade da classe. 
        */

        return $this->apiResponseCreateData($validateData);
    }

    /**
     *  Trabalhando de uma forma mais elegante com Requests 
     */
    public function update(Request $request){
        
        # crinado um array associativo que representa as regras de dados
        # para validar e filtrar os dados envido pela requisição
        # muito util para colocarmos no parâmetro $rule de Request::make->validate() 

        $rules = [
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'thumb' =>'required|string|max:255',
            'release_date' =>'required|date',
        ];

        // esse aqui nao vou adicionar, vai ser mais para um estudo mesmo
        // basicamente podemos usar mensagens de retorno caso um dado nao passe pela rule
        $messages =[
            'name.required' => "O nome do Game(Jogo) é obrigatório",
        ];

        // Usando um metodo estático da class Validator, para realizar uma validacao de dados

        $validator = Validator::make($request->all(),$rules);

        /*
            Metodos do obeto validator:

            $validator->fails(): Retorna um booleano (true/false).
            $validator->errors(): Retorna um objeto de mensagens de erro (muito útil para APIs).
            $validator->validated(): Retorna apenas os dados que estavam nas regras
        
        */

        // 2. Verifica se FALHOU antes de seguir
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors'  => $validator->errors() // Retorna suas mensagens customizadas aqui
            ], 422);
        }
        
        $data = $validator->validated();

        return $this->apiResponseUpdateData($data, $data['id']);

    }

}