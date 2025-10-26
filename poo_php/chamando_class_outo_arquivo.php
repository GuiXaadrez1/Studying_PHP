<?php

    // recomendo que leia o artigo: https://github.com/GuiXaadrez1/Studying_PHP/blob/main/doc/2%20-%20notas/3%20-%20Include_vs_Require.md
    
    // para entender o funcionamento de "include" e "require", "include_once" e "require_once"

    // neste caso estamos no mesmo diretório, por isso não é necessário colocar o caminho completo

    // se estiver em diretórios diferentes, deve-se colocar o caminho completo
    // require_once "poo_php/class_atributo_metodo.php";
    
    require_once "class_atributo_metodo.php";

    // vai retornar um erro fatal se o arquivo não for encontrado
    // tudo na outra página ou arquivo será carregado aqui, podendo aparacer na tela

    // agora podemos instanciar objetos da classe Saiyajin
    $goku = new Saiyajin(); 
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo($goku->saludar());




?>