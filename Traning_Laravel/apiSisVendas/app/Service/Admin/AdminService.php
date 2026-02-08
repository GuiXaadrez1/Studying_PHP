<?php

namespace App\Service\Admin;

// A comunicação entre repository, model, banco de dados vai fica na service

// vamos passar a instância de repositories para controller...
// via DI, indejão de depedência

use App\Repositories\Contracts\AdminInterface;

class AdminService
{
    /**
     * Create a new class instance.
     */

    private $adminRepository;

    public function __construct(AdminInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    // métodos auxiliares
    protected  function capitalize($str = '') {
        if (gettype($str) !== 'string') {
            return '';
        }
        #mb_strtoupper -> transforma todos os caracetres da string em maiúscula
        return mb_strtoupper(
            # primeiro mb_substr -> pega uma parte da string
            mb_substr($str, 0, 1)) . mb_substr($str, 1);
            # segundo mb_substr -> concatena o restante da string com o primeiro mb_substr
    }

    // método a serem usados no controller
    public function getActivyAdmins(){
        return $this->adminRepository->findAllActivyAdmins();
    }

    public function getActivyAdmin(int $id){
        return $this->adminRepository->findActivyAdmin($id);
    }

    public function getAdmin(int $id){
        return $this->adminRepository->findAdmin($id);
    }

    public function register($data,int $idadminfk){
        // Corrigir aamanhã... o tratamento de dados para serem
        // inseridos no banco de dados, deve ser realizados no service e nao
        // no repository, o repository vai fazer um papel de dao
        
        /**
         * Essa funcao pega a primiera letra e transforma em 
         * letra maiúscula
        */

        $data['codadmin'] = (int) $data['codadmin'];
        $data['nome'] = $this->capitalize($data['nome']);
        $data['email'] = strtolower($data['email']);
        $data['senha'] = bcrypt($data['senha']);

        return $this->adminRepository->insert($data,$idadminfk);
    }

    public function notExistAdm(int $id){
        return $this->adminRepository->isIdAdminDeleted($id);
    }

    public function adminUptade(int $id,$data){

        $data['nome'] = $this->capitalize($data['nome']);
        $data['email'] = strtolower($data['email']);
        $data['senha'] = bcrypt($data['senha']);

        return $this->adminRepository->update($id,$data);
    }
    
    // Realizando o método de delecao lógica
    public function softDelete(int $id){

        // A Service define a data e passa para o Repository
        $dataDelete = now();

        //dd($dataDelete);
        
        //dd($id);

        return $this->adminRepository->delete($id, $dataDelete);
    }
}
