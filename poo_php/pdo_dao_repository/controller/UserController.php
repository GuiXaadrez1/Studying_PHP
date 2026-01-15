<?php

    // Controller orquestra as acoes entre Model e DAO PARA realizar as operacoes
    // Aqui se Resve as requisições do usuário, processa os dados e interage com o Model e o DAO
    // Basicamente toda a regra de negocio é tratada aqui no Controller

    // criando um namespace para organizar as classes de Controller
    namespace Pdo\Controller;

    // importando as classes de DAO e Model e de conexao com o banco de dados
    use Pdo\DaoPdo\UserDAO;
    use Pdo\Model\UserModel;
    use Pdo\DatabasePdo\BdConnection;

    /**
     *  Coisas para aplicar no futuro:
     *  
     * CRIAR UM ARQUIVO ABASTRATOR DA CONTROLLER PARA PASSAR AS CONFIGURAÇÕES GERAIS
     * COMO POR EXMEPLO A CONEXAO COM O BANCO DE DADOS
     * COM ISSO AS OUTRA CONTROLLER HERDAM ESSA CLASSE ABASTRATA COM ALGUMAS PROPRIEDADES
     * CONCRETAIS JA DEFINIDAS, ASSIM NAO É NECESSSARIO REPETIR O CODIGO DE CONEXAO EM CADA CONTROLLER CRIADA
     */

    // Definindo a class Controller de Usuario
    class UserController{

        // Declarando propriedade, atributos, dependencias
        // neste caso sao dependencias do DAO e da conexao com o banco e Model
        private $userDao;
        private $pdoConnection;
        private $userModel;

        public function __construct(array $dados){
            
            // Se a chave não existir no array (como na listagem), vira "" em vez de NULL
            $cpf   = $dados['cpf'] ?? "";
            $name  = $dados['name'] ?? "";
            $email = $dados['email'] ?? "";
            $tell  = $dados['tell'] ?? "";

            // Criando a instancia do Model com os dados recebidos
            $this->userModel = new UserModel($cpf, $name, $email, $tell);

            // Obtendo a conexao com o banco de dados via singleton
            $this->pdoConnection = BdConnection::getInstance();

            // Injetando a dependencia do Model e da conexao no DAO
            $this->userDao = new UserDAO($this->userModel, $this->pdoConnection);
        }

        // Aqui você pode adicionar métodos para manipular usuários
        // como createUser, getUser, updateUser, deleteUser, etc.

        // Adicione este método na sua UserController
        public function buscarTodos() {
            return $this->userDao->findAllUsers();
        }

        // Mantenha o listar() original para quando o acesso vier pelo index.php
        public function listar() {
            $users = $this->buscarTodos();
            include __DIR__ . '/../view/UserView.php';
        }

        public function findUser(){
            // Pegamos o CPF que veio do $_GET via construtor
            $cpf = $this->userModel->getCpf();
            
            $cpf = str_replace(['.','-'], '', $cpf);

            // atualizando o valor de cpf na model
            $this->userModel->setCpf($cpf);
            
            //echo ($cpf);
            //die();

            if($this->userModel->getCpf()===null || $this->userModel->getCpf()===""){
                header("Location: index.php?acao=listarUsers"); 
                exit;
            }

            // Pedimos ao DAO para buscar
            $user = $this->userDao->findUserByCpf($this->userModel->getCpf());
                
            // Para exibir, podemos reutilizar a View, mas passando apenas um usuário no array
            $users = $user ? [$user] : []; 
            include __DIR__ . '/../view/UserView.php';
        }

        public function cadastrar(){
            
            // Aqui você chamaria o método do DAO para inserir o usuário no banco de dados
            $this->userDao->insertUser();

            // 2. Garante que a sessão existe antes de gravar a mensagem
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Após cadastrar, você pode redirecionar ou retornar uma resposta
            // Por exemplo, definir uma mensagem de sucesso na sessão
            $_SESSION['msg'] = "Usuário cadastrado com sucesso!";

            // Após salvar, você força o retorno para a página do formulário
            
            header("Location: index.php?acao=listarUsers"); 
            exit;

        }

    }
?>  