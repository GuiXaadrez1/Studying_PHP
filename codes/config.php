<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> <!-- Define a codificação de caracteres para dar suporte ao pt-br -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Deixa responsivo em mobile -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Força compatibilidade Edge no IE -->
        <title> Este arquivo terá o nosso include</title>
    </head>
    <body>
        <?php
            echo('<p> 
                Este é o nosso arquivo config.php que vai servir como base para o include.<br>
                Se você leu esta mensagem em outro arquivo.php, parabéns!!!! O include deu certo.<br>
                Caso não veja é porque deu algum erro, como é um include, o servidor emite um *warning* (E_WARNING).<br>
                E não para execução do programa, sistema, ou seja. O script **continua** executando. 
            </p>')
        ?>
    </body>
</html>