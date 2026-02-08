<?php

namespace App\Repositories\Category;

use App\Models\Categoria;
use App\Repositories\Contracts\Categoryinterface;

// usando Eloquent para possíveis QueryBuilder
use Illuminate\database\Query\Builder;
use Illuminate\Support\Facades\DB;

class CategoryProductRepositories implements Categoryinterface
{
    /**
     * Create a new class instance.
     *
     * Passando a Model por Injecao de depedência
     * Afim de usar o poder da ORM no Repository
    */

    private Categoria $categoryModel;

    public function __construct(Categoria $model)
    {
        $this->categoryModel = $model;
    }

    /**
     * Retorna o registro de categoria 
     * idependentemente se ela foi deletada logicamente ou nao
     */
    public function findCategory($id){
        $data = $this->categoryModel->find(['nome','data_registro']);
        return $data;
    }

    /**
     * Retorna todas as categorias
     * indepedentemente se ela está ou não com Soft Delete
     */
    public function findAllCategory(){
        $data = $this->categoryModel->all(['nome','dthinsert as data_registro']);

        return $data;
    }

    /**
     * Retorna os registros da tabela 'category' contendo apenas
     * as colunas 'nome' e 'dthinsert'. Ou seja, basicamente estamos
     * Retornado todos os registros de categorias nao deletadas 
     * lógicamente.
     *
     * Os resultados são filtrados pelas condições:
     * - 'statusdelete' igual ao valor de $status
     * - 'dthdelete' igual ao valor de $data_delete
     *
     * @return \CodeIgniter\Database\BaseResult|array Lista de registros que atendem aos filtros
     */
    public function findAllCatagoryActivy(){
        
        # criando variáveis externas para passar com parâmetro 
        # na nossa clousure (funcao anonima), util para gerar filtros dinâmicos
        $status = false;

        $data = $this->categoryModel->select([
            'idcategoria',
            'nome', 
            'dthinsert as data_registro'])
            ->where(function($query) use ($status) {
                $query->where('statusdelete', $status)
                    ->whereNull('dthdelete');
            })->orderby('idcategoria','asc')->get();

        // Debugando a divergência de encoding 
        //dd(DB::select("SHOW client_encoding"),$data);

        return $data;
    }

    /**
     * Retorna a categoria ativa conforme o id passado
    */
    public function findCatagoryActivy(int $id) { 
        
        $status = false; 
    
        $data = $this->categoryModel->select([
            'idcategoria',
            'nome', 
            'dthinsert as data_registro']) 
        ->where(function ($query) use ($status, $id){ 
            
            $query->where('statusdelete', $status) 
                ->whereNull('dthdelete') ->where('idcategoria', $id); 
        
        }) ->get(); 
        
        return $data; 
    }

    public function isIdCategoryDeleted(int $id):bool{
        
        // se o administrador nao existir, retorna false! 
        if (!$this->categoryModel->find($id)){
            return false;
        }

        // O método exists() retorna true ou false direto do SQL (SELECT 1...)
        // Retorna TRUE se ele existir E estiver marcado como deletado
        return $this->categoryModel
            ->where('idcategoria', $id)
            ->where('statusdelete', true)
            ->whereNotNull('dthdelete')
            ->exists(); // retorna true ou false direto do SQL
    }


    /**
     * Rescebe um conjunto de dados necessários
     * para inserir uma categoria fisicamente no 
     * banco de dados, se tude de certo ele retorna true
     * se nao retornar true, vai quebrar aplicacao aqui rsrs
     */
    public function insert(int $idadmin,$data):bool{


       // Lembre-se: para que o create() funcione, os campos precisam estar 
       // listados no array $fillable do seu modelo Categoria. 
       // Se idadmin não estiver lá, adicione!
       
       $this->categoryModel->create([
        'nome' => $data['nome'],
        'idadmin' => $idadmin
       ]);

        return true;
    }   

    /**
     * Atualiza dinâmicamente as informações da categorias
     */
    public function update(int $idcategory, $data): bool
    {
        $category = $this->categoryModel->find($idcategory);

        if(!$category){
            return false;
        };

        return $category->update($data);
    }

    public function delete($id):bool{

        // valida se a category já foi deletada
        $categoryDeleted = $this->isIdCategoryDeleted($id);

        // dd($categoryDeleted); -> retorna false se nao for deletada e true se for deletada

        // se o resultado é true, retorna false 
        if($categoryDeleted){
            return false;
        }

        // retorna true se atulizar corretamente!
        // Lembre-se: O eloquesnt
        return $this->categoryModel 
            ->where('idcategoria', $id) 
            ->update([ 'statusdelete' => true, 'dthdelete' => now(), ]);

        // ATENÇÃO ISSO É IMPORTANTE PARA ELOQUENT VS QUERY BUILDER:

        /* 
            No Model diretamente ($this->categoryModel->update([...])):
                Isso tenta atualizar todos os registros da tabela, porque não há 
                filtro de where ou find. É por isso que não funcionava no seu caso.

            No Query Builder (where()->update([...])):
                Atualiza apenas os registros que correspondem ao filtro. Exemplo:
                            
                    $this->categoryModel
                    ->where('idcategoria', $id)
                    ->update([
                        'statusdelete' => true,
                        'dthdelete'    => now(),
                    ]);
                
                  Aqui o Eloquent gera um UPDATE categoria SET ... WHERE idcategoria = ?.

            No Model instanciado (find()->update([...])):
                Primeiro busca o registro, depois aplica o update. Exemplo:
                    
                    $category = $this->categoryModel->find($id); 
                    if ($category) { 
                        $category->update([ 
                            'statusdelete' => true, 
                            'dthdelete' => now(), 
                        ]); 
                    }

        */
    }
}
