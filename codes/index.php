<?php
    declare(strict_types=1); // ativando tipagem explícita
    include_once 'tipo_dados.php';
    include_once 'phpdoc.php';
    include_once 'filtros.php';

    $resultado = somarinteiros(3000, 5000);
    $comentario = "Então Morty, você não vai conseguir ver esse comentário por inteiro porque a função reduzirTexto não vai deixar, fiz isso porque você não gosta de explicações prolongadas..."; 
    // $comentario = 10 //para fazer o teste;    
?>
<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-- Define a codificação de caracteres para dar suporte ao pt-br -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Deixa responsivo em mobile -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Força compatibilidade Edge no IE -->
    </head>
   <body>        
        <img src = "/Studying_PHP/img/Rick_Picles.jpg" width="150" height="200">
        <h3>EU VIREI UM PICLES MORTY</h3>
        <img src = "/Studying_PHP/img/Morty_Rick.png" width="200" height="200"/>
        <h3>Morty essa Página foi criada para podermos brincar com funções e tipo de dados em PHP</h3>
        <p>CLIQUE AQUI MORTY! PARA TER ACESSO AS INFORMAÇÕES DO SERVER:<a href = 'http://localhost/Studying_PHP/codes/infoServer.php'>CLIQUE AQUI<a></p>
        <p>URL_PRODUCAO do nosso site definida por uma constante: <a href="<?=URL_PRODUCAO?>">Clique aqui</a> , Não esqeuça de olhar bem a URL</p>
        <p>Morty o Resultado da soma da função importada do arquivo tipo_dado é: <b><?= $resultado ?></b></p>
        <p><?= is_int($comentario); ?></p>
        <p><?= reduzirTexto($comentario); ?></p>
        <p><?= funcaoQualquer(); ?></p>
        <p>Testando essa função com o operador ternário, o valor lógico (tabela lógica) do resultado é: <?=funcaoOperadorTernario()?></p><br>
        <p>Esse Short Open Tag é muito bom Morty! Saca Só:<br><?= formatar_value()?><br>Acima está um número Padrão formatado pela nossa função number_format</p>
        <br>
        <p><?=formartar_number()?></p>
        <!--<p><#?= fusioHorarioPadrão()?></p>-->
        <p><?=contarTempo('2025-07-14 17:59:0')?></p>
        <p>Esse email é válido? Se retornar 1, sim, se retornar 0 é inválido, O RESULTADO É: <?=validarEmail("guix1delas@gmail.com")?> </p>
        <p>Esse url é válida? Se retornar 1, sim, se retornar 0 é inválido, O RESULTADO É: <?=validarUrl("https://localhost:8080/admin")?> </p>
        <p>Realizando Teste do nosso Validador de URL Personalizado com a CONSTANTE definida por padrão: <?=var_dump(validarUrlPersonalizada())?> </p>
    </body>
</html>

<?php
/* 
    1️⃣ declare(strict_types=1); ativa a tipagem estrita e só funciona se for a PRIMEIRA instrução do arquivo.
    2️⃣ Nada pode vir antes dela: nem espaço fora da tag <?php, nem HTML, nem comentários soltos.
    3️⃣ Se o PHP ler qualquer caractere fora da tag <?php antes, ele já manda conteúdo pro navegador → trava o declare.
    4️⃣ Por isso, o bloco <?php declare(strict_types=1); precisa ser o PRIMEIRO a rodar, antes de tudo.
    5️⃣ Depois do declare e includes, você pode fechar ?> e abrir HTML normalmente.
    6️⃣ Assim o PHP configura o motor para exigir tipos exatos antes de gerar qualquer saída.
    7️⃣ Se misturar HTML antes, o interpretador já está enviando bytes para o cliente → e o declare não tem mais efeito.
    8️⃣ Para projetos modernos, é boa prática separar lógica PHP no topo e visual depois, ou usar templates (Twig, Blade).
    9️⃣ Exemplo padrão: <?php declare(strict_types=1); include ... ?> <!DOCTYPE html>....
    🔟 Seguindo isso, você garante coerção forte e sem erros silenciosos de tipo.
*/
?>