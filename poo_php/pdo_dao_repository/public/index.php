<?php

    // Aqui vai ficar o nosso Front Controller na nova versão com Autoload
    // ou seja o ponto de entrada da aplicação

    // Em vez de ter vários arquivos, você usa apenas UM arquivo na public/ 
    // (geralmente o index.php). 
    // Ele recebe uma informação extra na URL dizendo o que o usuário quer fazer.

    require_once __DIR__ . '/../vendor/autoload.php';

    // Capturamos a "ação" que vem pela URL (ex: index.php?acao=cadastrar)
    // Ou seja... No seu HTML (A View): No action, você adiciona um parâmetro na URL chamado acao.
    // O PHP pega esse valor da URL e joga no switch. 
    // formato da url que deve estar no parametro action do form: <form action="../public/index.php?acao=cadastrarUser" method="POST">
    
    $acao = $_GET['acao'] ?? 'listarUsers'; // Se vazio, assume listarUsers

    // ?? -> é o operador de coalescência nula do PHP
    // basicamente estamos dizendo: se $_GET['acao'] existir, atribua seu valor a $acao
    // caso contrário, atribua uma string vazia '' 

    // se a requisição for via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Roteamento simples usando switch-case
        switch ($acao) {
            // se a acao da URL for cadastrar-usuario
            case 'cadastrarUser':

                // Realizando tratamento de dados recebidos via POST
                
                $cleanCpf = str_replace('.', '', $_POST['cpf']);
                $_POST['cpf'] = str_replace('-', '', $cleanCpf);

                //echo $_POST['cpf'];

                // materializamos a chamada da Controller
                $controller = new \Pdo\Controller\UserController($_POST);
                // aplicamos a ação desejada
                $controller->cadastrar();
                break;
            
            case 'atualizarUser':
                $controller = new \Pdo\Controller\UserController($_POST);
                //$controller->alterar();
                break;
        }
    }

    // Agora se for via GET
    else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        // Roteamento simples usando switch-case
        switch ($acao) {
            case 'listarUsers':
                $controller = new \Pdo\Controller\UserController($_GET);
                $controller->listar();
                break;

            case 'findUserByCpf':
                $controller = new \Pdo\Controller\UserController($_GET);
                $controller->findUser();
                break;
        }
    }

?>