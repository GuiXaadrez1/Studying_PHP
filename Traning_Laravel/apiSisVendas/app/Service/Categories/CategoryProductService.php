<?php

namespace App\Service\Categories;

use App\Repositories\Contracts\Categoryinterface;

class CategoryProductService
{
    /**
     * Create a new class instance.
     */

    private Categoryinterface $categoryRepository;

    public function __construct(Categoryinterface $repository)
    {
        $this->categoryRepository = $repository;
    }


    /**
    * Método criado para auxiliar outros métodos
    */
    protected  function capitalize($str = '') {
        if (gettype($str) !== 'string') {
            return '';
        }
        return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }

    // Procura por um registro de categoria, idependente se ele foi deletado ou nao
    public function getCategory($id){
        return $this->categoryRepository->findCategory($id);
    }

    /**
     * Serviço que lista todas as categorias ativas
     * ou seja, nap deletadas logicamente
     */
    public function listAllCategory(){
        return $this->categoryRepository->findAllCatagoryActivy();
    }

    /**
     * retorna específicamente aquela categoria nao
     * deletada logicamente 
     */
    public function printCategoryActivy($id){
        return $this->categoryRepository->findCatagoryActivy($id);
    }


    public function notExistCategory($idcategory){
        return $this->categoryRepository->isIdCategoryDeleted($idcategory);
    }

    public function register(int $idadmin,$data):bool{

        if(!$data){
            return false;
        }

        $data['nome'] = $this->capitalize($data['nome']);
        
        // dd($idadmin,$data); teste realizado com sucesso!
        
        $ok = $this->categoryRepository->insert($idadmin,$data);   
        
        if(!$ok || !$ok === false){
            return false;
        }

        return true;
    }


    public function categoryUpdate($idcategory,$data){
        
        // deixando o priemiro caracter em Uppercase 
        $data['nome'] = $this->capitalize($data['nome']);

        return $this->categoryRepository->update($idcategory,$data);

    }

    /**
     * Deleta lógicamente o registro
     */
    public function softDelete(int $id){

        //dd($id);
        return $this->categoryRepository->delete($id);
    }

}
