<?php

    namespace App\Repositories\Contracts;  
    
    use App\Models\User;

    // crinado um contrato ou interface para o repository
    // aqui definimos como um método é estruturado
    // nao possui lógica de implementação, negoção ou acesso a dados
    // apenas definimos o método que deve ser implementado
    // ou seja, apenas a assinatura do método

    interface UserRepositoryInterface{

        public function create(array $data):bool;
        public function find(int $id);
    }

?>