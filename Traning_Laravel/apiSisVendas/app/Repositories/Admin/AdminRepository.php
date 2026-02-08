<?php

namespace App\Repositories\Admin;

// obtendo o nosso contrato
use App\Repositories\Contracts\AdminInterface;

// importando models para repository
use App\Models\Admin;

// usando Eloquent para possíveis QueryBuilder
use Illuminate\database\Query\Builder;
use Illuminate\Support\Facades\DB;

class AdminRepository implements AdminInterface
{
    /**
     * Create a new class instance.
     */
    
    // criando uma instância da class modal
    // passando por injecao de depedência com composição
    private $admin;
    
    public function __construct(){
        $this->admin =  new Admin();
    }

    /**
     * Este método vai retornar todos os administradores 
     * independente do seu status de delecao lógica
     * ao menos que ele nao exista físicamente no db
     */
    public function findAllAdmins():object{
        return $this->admin->all([
            'idadmin',
            'codadmin',
            'nome',
            'email',
            'dthinsert as data_registro',
            'dthdelete',
            'statusdelete']
        );
    }
    
    /**
     * Este método retorna informacoes do administrador
     * indepedentemente do seu status de delecao lógica
     */
    public function findAdmin($id):?object{
        //dd($this->admin->find($id));
        return $this->admin->find($id);
    }
    
    public function findAllActivyAdmins():?object
    {
        /*$result = $this->admin->all([
            'idadmin',
            'codadmin',
            'nome',
            'email'
        ]);*/

        $result = $this->admin->select([
            'idadmin as id',
            'codadmin',    
            'nome',
            'email',
        ])->where('statusdelete','=',false)->whereNull('dthdelete')
        ->orderBy('idadmin', 'asc') // 'asc' para ordem crescente, 'desc' para decrescente
        ->get();

        return $result;
    }

    public function findActivyAdmin(int $id):?object
    {

        $result = $this->admin->select([
            'idadmin as id',
            'codadmin',
            'nome',
            'email',
            'dthinsert as data_registro',
            'statusdelete as deletado'
        ])
        ->where('idadmin', $id)
        ->where('statusdelete', false)
        ->whereNull('dthdelete')
        ->first();

        if(!$result){

            // Cria um objeto generico vazio
            $result = null;
        }

        return $result;
    }
    
    public function isIdAdminDeleted(int $id):bool{
        
        // se o administrador nao existir, retorna false! 
        if (!$this->admin->find($id)){
            return false;
        }

        // O método exists() retorna true ou false direto do SQL (SELECT 1...)
        // Retorna TRUE se ele existir E estiver marcado como deletado
        return $this->admin
            ->where('idadmin', $id)
            ->where('statusdelete', true)
            ->whereNotNull('dthdelete')
            ->exists();
    }

    public function insert($data,int $idadminfk):bool{
        
        // Cria uma NOVA instância para garantir um novo INSERT
        $novoAdmin = $this->admin->newInstance(); 
        
        $novoAdmin->idadminfk = $idadminfk;
        $novoAdmin->codadmin = $data['codadmin'];
        $novoAdmin->nome = $data['nome'];
        $novoAdmin->email = $data['email'];
        $novoAdmin->senha = $data['senha'];

        return $novoAdmin->save();
    }

    public function update(int $id,$data):bool{

        $adm = $this->admin->find($id);

        if (!$adm){
            return false;
        }

        return $adm->update($data);
    }

    public function delete(int $id,$dataDelete):bool{

        // Só buscamos se ele ainda estiver ATIVO
        $adm = $this->admin
            ->where('idadmin', $id)
            ->where('statusdelete', false)
            ->first();

        //dd($adm);

        if (!$adm) {
            return false; // ou lançar exceção
        }

        /*return $adm->update([
            'dthdelete'    => $data,
            'statusdelete' => true, // Forçamos true 
        ]);*/

        // se o método update nao esta funcionando, vamos de save mesmo

        $adm-> dthdelete = $dataDelete;
        $adm->statusdelete = true;

        // usando save para atualizar
        return $adm->save();
    }
}
