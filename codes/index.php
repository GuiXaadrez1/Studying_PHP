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
        <?php
            include_once 'tipo_dados.php';

            $resultado = somarinteiros(3000,5000);

            echo("<p>Morty o Resultado da soma da função importada do arquivo tipo_dado é: <b>". $resultado ."</b>" . "</p>");
        ?>
    </body>
</html>