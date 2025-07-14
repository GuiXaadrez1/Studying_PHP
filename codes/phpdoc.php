<?php
    declare(strict_types=1); // declarando diretiva para deixar tipagem explícita!

    /*  Esse arquivo.php tem como objetivo aprender sobre documentação em PHP
        Lembre-se do DocString do python? Então, nasicamente é a mesma coisa.
        diferente de DocString do Python, chamamos de PHPdoc
        segue o link -> https://phpdoc.org/  (cntrl + click encima para entrar no link)
        para saber mais sobre o PHPdoc
    */

    // Abaixo está a sintaxe do nosso PHPdoc e ele tem várias tags uma delas é o @param e o @return

    /**
     * Rescebe e devolve o texto 
     * 
     * @param string $Texto parâmetro que rescebe um texto
     * @return string 
    */

    function funcaoQualquer(string $Texto = "Comentário que fiz para textar o valor padrão de parâmetro da função") {
        try{
            
            // Se o texto realmente for uma string, retornar esse texto
            if ( is_string($Texto) == true ){

                $textoLimpo = trim($Texto);
                return $textoLimpo;
            };
            
        }catch(Throwable $e){
            return "Aconteceu alguma cagada aqui MOrty: " . $e ->getMessage();

        };   
    };

    /**
     * Essa função mostrar o valor de um resultado se é false ou true com um operador ternário
     * Sintaxe básica do operador ternário: 
     *  ( condição) ? expressão_true : expressão_false; (não esqucer dos :)
     * @param bool $Resultado é um parâmetro booleano que por padrão já possui valor true
     * 
     */

    function funcaoOperadorTernario($Resultado = true ):bool {
        try{
            if(is_bool($Resultado)){
                echo ($Resultado == true) ? 'true' : 'false';
                return $Resultado;
            }else{
                echo "Não é booleano!";
                return false;
            };  
        }catch(Throwable $e){
            echo("Aconteceu algum erro aqui: ". $e->getMessage());
            return true;
        };
    };
?>