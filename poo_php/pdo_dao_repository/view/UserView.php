<?php 
    session_start(); 

    if (!isset($users)) {
        require_once __DIR__ . '/../vendor/autoload.php';
        
        // Passamos um array vazio pois não estamos processando formulário agora
        $controller = new \Pdo\Controller\UserController(['cpf'=>null, 'name'=>null, 'email'=>null, 'tell'=>null]);
        
        // CHAMADA CORRETA: apenas pega os dados, não inclui a view de novo
        $users = $controller->buscarTodos(); 
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <?php 
        // 1. Verifica se existe uma mensagem de sucesso na sessão
    ?>
    <?php if (isset($_SESSION['msg'])): ?>
        <div style="color: green; font-weight: bold; border: 1px solid green; padding: 10px; margin-bottom: 20px;">
            <?= $_SESSION['msg']; ?>
        </div>
        <?php 
            // 3. Limpa a mensagem para ela sumir no próximo F5
            unset($_SESSION['msg']); 
        ?>
    <?php endif; ?>

    <h2>Cadastro de Usuário</h2>

    <form action="../public/index.php?acao=cadastrarUser" method="POST">
        <input type="text" name="cpf" placeholder="CPF" required>
        <input type="text" name="name" placeholder="Nome" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="text" name="tell" placeholder="Telefone" required>
        <button type="submit">Enviar Dados</button>
    </form>
        
    <hr>

    <h2>Buscar Usuário por CPF</h2>

    <form action="../public/index.php" method="GET">
    <!--
        Como queremos enviar o dado para fazer a busca via GET
        basicamenteestamso criando uma URL bem simples:
        
        A anatomia da URL gerada
        
        Se o seu arquivo está em public/index.php, a URL na barra de endereços vai mudar para:

        http://localhost/projeto/public/index.php?acao=findUserByCpf&cpf=123

        ?: É a fronteira. Tudo antes dele é o caminho do arquivo. Tudo depois são os dados.

        acao=findUserByCpf: O PHP lê isso e coloca no array $_GET['acao'].

        &: É o separador. Ele diz: "aqui termina um dado e começa outro".

        cpf=123: O PHP lê isso e coloca no array $_GET['cpf'].
    -->
        <input type="hidden" name="acao" value="findUserByCpf">
        <input type="text" name="cpf" placeholder="Buscar por CPF...">
        <button type="submit">Buscar</button>
    </form>

    <hr>

    <h3>Lista de Usuários</h3>
    <table border="1">
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($users) && is_array($users)): ?>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= $u['cpf'] ?></td>
                        <td><?= $u['nome'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['tell'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum usuário encontrado ou acesse via listarUsers.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
</body>
</html>