<?php
    
    // FORMA ANTIGA DE CRIAR AUTOLOAD DE CLASSES NO PHP 

    // Aqui vai ficar o nosso Front Controller ou seja o ponto de entrada da aplicação
    // Basicamente vai funcionar como uma "Rota" para direcionar as requisições para as controllers corretas
    // Nesse caso estamos apenas incluindo a view de cadastro de usuario
    
    // Aqui você daria require nas suas classes ou usaria Autoload (Vamos ver posteriormente)
    
    require_once "../controller/UserController.php"; 
    require_once "../model/UserModel.php";
    require_once "../dao/UserDAO.php";
    require_once "../pdo/pdo.php";

    // IMPORTANTE: O 'use' não carrega arquivos. 
    // Você precisa dizer ao PHP ONDE os arquivos estão fisicamente.
    
    use Pdo\Controller\UserController;

    // Se o formulário foi enviado, aciona a Controller

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_POST['cpf'], $_POST['nome'], $_POST['email'])) {
            // Dados incompletos no formulário
            die('Por favor, preencha todos os campos do formulário.');
        };

        // tirando pontos e traços do CPF
        $cleanCpf = str_replace(['.', '-'], '', $_POST['cpf']);

        // Pecorrendo sobre o array da variavel super global POST
        foreach($_POST as $key => $value){
            // limpando os dados para evitar ataques XSS
            $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));

            echo "$key : $value <br> ";
        }

        echo 'CPF Limpo: ' . $cleanCpf . '<br>';

        // Pegando todos os dados do Post
        $dados = [
            'cpf' => $cleanCpf,
            'name' => $_POST['nome'],
            'email' => $_POST['email']
        ];

        $controller = new UserController($dados);
        $controller->cadastrar();
    }
?>