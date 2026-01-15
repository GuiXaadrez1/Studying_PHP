<?php

    // DAO é um padrao de projeto para acesso a dados
    // Ele abstrai e encapsula todas as interações com a fonte de dados

    // criando um namespace para organizar as classes de DAO
    namespace Pdo\DaoPdo;

    # importando a classe de conexao com o banco de dados
    use Pdo\DatabasePdo\BdConnection;; # apenas para tipagem

    /*
        Observao importante:

            Optei pela abordagem de injeção de dependência por inversoa de controle 
            (IoC - Inversion of Control)
            
            Isso significa que a responsabilidade de criar e fornecer a instância de 
            BdConnection

            para o UserDAO é transferida para quem for instanciar o UserDAO.
            
            No caso UserModel ou UserController. Isso promove um baixo acoplamento entre as
            classes, facilitando testes unitários e manutenção   
    
        */

    # importando a class Model de Usuario
    # justamente para mapear os dados do banco para objetos
    # model conversa com DAO
    # DAO com o banco

    use Pdo\Model\UserModel; # apenas para tipagem

    class UserDAO{

        private $conn;
        private $user;

        public function __construct(UserModel $user, BdConnection $pdoConnection){
            $this->conn = $pdoConnection;
            $this->user = $user;
        }
        
        // Criando metodos para CRUD (Create, Read, Update, Delete)

        public function findAllUsers(){
            $sql = "SELECT cpf, nome, tell, email FROM usuario";

            $stmt = $this->conn->getConnection()->prepare($sql);

            // se o resultado da execucao for verdadeiro e tiver mais de 0 linhas
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                // retorna todos os dados
                return $stmt->fetchAll($this->conn->getConnection()::FETCH_ASSOC);

                // como ja estamos pegando um objeto pdo com o get
                // basta usarmos o operador de resolução de escopo (::) para acessar a constantes
                // como FETCH_ASSOC    
            }

            // caso ao contrário retorne um array vazio
            return [];
        }

        public function findUserByCpf(string $cpf){
            
            $sql = "SELECT cpf, nome, tell, email FROM usuario WHERE cpf = ?";
            
            $stmt = $this->conn->getConnection()->prepare($sql);
            $stmt->bindValue(1, $cpf);
            $stmt->execute();
            
            // Retorna apenas um array com 1 usuário
            // return $stmt->fetch($this->conn->getConnection()::FETCH_ASSOC);

            return $stmt->fetch($this->conn->getConnection()::FETCH_ASSOC);
        }
        //public function findById(int $id){};

        public function insertUser(){
            // echo "Inserindo usuário no banco de dados...<br>";

            $data = [
                $this->user->getCpf(),
                $this->user->getName(),
                $this->user->getTell(),
                $this->user->getEmail(),
            ];
            
            /*foreach($data as $value){
                echo $value . "<br>";
            }*/
            
            // Preparando o SQL com placeholders para evitar SQL Injection

            $sql = "INSERT INTO usuario (cpf, nome, email, tell) VALUES (?,?,?,?)";

            // statement é um objeto que representa a consulta preparada
            // por isso o nome da variavel é stmt (statement)
            $stmt = $this->conn->getConnection()->prepare($sql);

            // Agora vamos associar os nomes dos placeholders com os valores reais com bindValue
            
            // lembrando que bind é a passagem de valores para os placeholders
            // ou seja passamos os valores para a consulta preparada
            // o primeiro valor é a posicao do placeholder (1,2,3...)
            // o segundo valor é o valor que queremos associar ao placeholder

            $stmt->bindValue(1, $this->user->getCpf());
            $stmt->bindValue(2, $this->user->getName());
            $stmt->bindValue(3, $this->user->getEmail());
            $stmt->bindValue(4, $this->user->getTell());

            // Executando o sql preparado  pelo statement
            $stmt->execute();

            // Observação:

            // No PDO, quando você passa um array para o execute(), 
            // ele automaticamente mapeia os valores para as interrogações ? na ordem 
            // em que aparecem.

        }

        /*
            Realiza o update com base no CPF do usuário
            pode atualizar todasa ou algumas informações
        */
        public function updateUser(){
            /* 
                Criando uma Sql Dinâmico -> Dynamic SQL Update 
                Estou usando essa abordagem para justamente evitar de usar lógica na controller
                fazendo primeira a consulta dos dados, verificar se os dados enviados via
                metodo POST são diferentes dos que estão no banco e só ai montar o SQL de update
                caso contrário se o usuário não alterar nada, não faz sentido executar um update
                que não altera nada no banco de dados.
            */
            
            // array de campos
            $field = [];

            // array de valores 
            $value = [] ;

            // Verificação lógica de campos preenchidos
            if (!empty($this->user->getName())) {
                $fields[] = "nome = ?";
                $values[] = $this->user->getName();
            }
            if (!empty($this->user->getEmail())) {
                $fields[] = "email = ?";
                $values[] = $this->user->getEmail();
            }
            if (!empty($this->user->getTell())) {
                $fields[] = "tell = ?";
                $values[] = $this->user->getTell();
            }

            if (empty($fields)) return false; // Nada para atualizar

            // O CPF é sempre necessário para o WHERE
            $values[] = $this->user->getCpf();
            
            $sql = "UPDATE usuario SET " . implode(', ', $fields) . " WHERE cpf = ?";
            
            $stmt = $this->conn->getConnection()->prepare($sql);
            return $stmt->execute($values);
        }

        /*
            Realiza o Delete com base no CPF do usuário
            optei por essa abordagem porque achei mais fácil
            porem geralmente usa-se o ID como chave primaria
            da tabela para fazer essa operação
        */
        public function deleteUser(){

            $sql = "DELETE FROM usuario WHERE cpf = ?";
            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->bindValue(1, $this->user->getCpf());

            // Executando o sql preparado  pelo statement
            $stmt->execute();
        }
    
    };

?>