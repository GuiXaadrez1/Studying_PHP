<?php

    namespace App\Repositories\User;    

    // Comunica com repository para realizar lógica de acesso ao banco de dados
    // e toda a parte de persistência de dados
    
    // Resumindo, repository separa a lógica de negócio da aplicação
    // da lógica de acesso a dados, deixando o código mais organizado
    // aqui realizamos operações como criar, ler, atualizar e deletar usuários
    // no banco de dados  e criamos métodos específicos para essas operações
    // através de um contrato (interface) que define quais métodos devem ser implementados
    // na pasta Contracts/User
    // Com isso podemos fazer o bind e realizar injeção de dependência
    // Exemplo: se uma class controller ou service resceber um contrato definido
    // em interface, ele vai materializar um objeto criado em repository que implementa
    // esse contrato (interface)
    
    // usando a representação da nossa tabela afim de realizar o CRUD
    use App\Models\User;

    // usando o contrato/interface
    use App\Repositories\Contracts\UserRepositoryInterface;

    // crinado a nossa class repository

    class UserRepository implements UserRepositoryInterface {
        
        //private $data;

        public function __construct(){}

        public function create(array $data):bool{
            
            // definido atributos publicos
            $user = new User();
            $user->name = $data[User::NAME];
            $user->email=$data[User::EMAIL];
            // deixando os nomes de usuarios tudo em minusculos
            $user->username=strtolower($data[User::USERNAME]);
            $user->password=bcrypt($data[User::PASSWORD]);
            
            // salvando dados no banco de dados, ele retrona true se salvar os registros
            return $user->save();
        }

        // esse método retorna um object
        public function find(int $id){
            $user = User::find($id);

            return $user;
        }

        public function update(int $id, array $data):bool{
            
            $user = User::find($id);

            return $user->update($data);
        }
    }

?>