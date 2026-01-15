<?php
    // Vamos criar exatamente a mesma lógica em cadastraUser.php
    // porem iremos usar Autoload para carregar as classes automaticamente
    // Isso evita que tenhamos que ficar dando require_once em cada arquivo

    // Para isso vamos utilizar o padrao PSR-4 de Autoloading com Composer

    // Recomendo que acesse o site PHP FIG (https://www.php-fig.org/psr/) 
    // para entender melhor sobre os padroes PSR

    // Lembrando que  é necessario instalar o Composer na sua maquina

    require_once "../vendor/autoload.php"; // Carrega o Autoload do Composer 
    // estabelecido na pasta vendor criada pelo Composer
    // isso é importante para que o autoload funcione corretamente
    
    // Agora todas as classes serão carregadas automaticamente quando usadas

    use Pdo\Controller\UserController;

    // Se o formulário foi enviado, aciona a Controller
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_POST['cpf'], $_POST['nome'], $_POST['email'])) {
            // Dados incompletos no formulário
            die('Por favor, preencha todos os campos do formulário.');
        };

        // tirando pontos e traços do CPF
        $cleanCpf = str_replace(['.', '-'], '', $_POST['cpf']);

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

    // O problema é que para cada funcionalidade nova, teriamos que criar um novo arquivo.php
    // para cada ação diferente (cadastrar, listar, editar, deletar, etc)
    // Isso não é muito eficiente e pode gerar muitos arquivos desnecessários
    // No próximo passo, vamos criar um Front Controller para centralizar todas as requisições

?>