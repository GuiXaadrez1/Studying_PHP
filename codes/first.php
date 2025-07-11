<!DOCTYPE html> <!-- Estamos nos referindo ao HTML5 -->
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8"> <!-- Define a codificação de caracteres para dar suporte ao pt-br -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Deixa responsivo em mobile -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Força compatibilidade Edge no IE -->
        <title>Primeiro Programa em PHP</title> <!-- Título da página -->
    </head>
    <body>
        <p>Esse arquivo.php vai servir como base para entender o require!</p>
        <?php
            echo("Se você está vendo essa mensagem é porque o require deu certo seu otário! Fique feliz por isso Morty.");
            echo("<br>");
            echo("<img src='/Studying_PHP/img/rick_img.jpg' />")
        ?>
        <p>Sugiro que utilize F12 para ver as mensagens que coloquei em um script JavaScript na função console.log() dentro da função echo() do PHP</p>
        <?php 
            echo("<script> console.log('Aqui está o nosso primeiro programa em PHP!'); </script>");
            echo("<script> console.log('Você não está vendo, mas em F12, esse é o meu console.log(), print(), System.out.println(), printf() em PHP, mais conhecido como echo().'); </script>");
            echo("<script> console.log('Sua missão é simplesmente exibir na tela ou console, uma mensagem!'); </script>");
            echo("<script> console.log('PHP tem uma sintaxe parecida com C, Python, JavaScript, TypeScript e Java, porém tem uma parte importante na sintaxe.'); </script>");
            echo("<script> console.log('NÃO se deve esquecer de colocar o ponto e vírgula no final de cada instrução, como no Java!'); </script>");
        ?>
        <?php echo("<p>Agora essa mensagem de echo é a que aparece no HTML! Te peguei OTÁRIO!</p>"); ?>
    </body>
</html>