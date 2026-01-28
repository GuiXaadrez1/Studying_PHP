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

    public function getAllAdmin()
    {
        $result = $this->admin->all([
            'idadmin',
            'codadmin',
            'nome',
            'email'
        ]);

        return $result;
    }

    public function getAdmin(int $id):object
    {
        $result = $this->admin->find($id,[
            'idadmin',
            'codadmin',
            'nome',
            'email'
        ]);

        if(!$result){

            // Cria um objeto generico vazio
            $result = new \stdClass();
        }

        return $result;
    }
    
    public function insert($data):bool{
        
        // Cria uma NOVA instância para garantir um novo INSERT
        $novoAdmin = $this->admin->newInstance(); 
        
        $novoAdmin->name = $data['nome'];
        $novoAdmin->email = $data['email'];
        $novoAdmin->senha = bcrypt($data['senha']);

        return $novoAdmin->save();
    }

    public function update(int $id,$data):bool{

        $adm = $this->admin->find($id);

        if (!$adm){
            return false;
        }

        return $adm->update($data);
    }
}
