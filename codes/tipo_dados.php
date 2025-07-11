<?php 
    // O objetivo deste script php é colocar os principais tipo de dados e brincar com tipagem de parâmetros, retorno e casting
    // para mais detalhes visite o meu respositório: https://github.com/GuiXaadrez1/Studying_PHP/blob/main/doc/notas/5%20-%20Tipo_Dados_PHP.md

    // "Lembre-se que PHP é fracamente tipado e possui tipagem dinâmica, ele é bem parecido com o javascript e python neste quesito"; 
    
    $string = "Esse é o nosso tipo de dado String"; // variável com o tipo de dado de valor string
    $integer = 10; // variável com o tipo de dado com valor inteiro
    $float_double = 12.5; // variável com valores quebrados oupontos flutuantes
    $bool = true || false; // variável com o tipo de dado verdadeiro ou falso
    $null = null; // variável com o tipo de dado de valor nulo, ou ausência de valor
    $array = ['Maça','Banana','Peixe']; // variável com tipo de dado array, Coleção indexada de valores
    //$resource = fopen("arq.txt",'r'); // variável que referência para recurso externo
    $callable = function(){return null;}; // variável que comporta uma Função anônima ou callback, funciona como um Arrow_function do JavaScript ou TypeScript
    
    function exemplo(mixed $entrada): mixed {
        return $entrada;
    }; // mixed é um tipo de dado que suporta qualquer Valor

    // agora vamos criar funções simples que possuem tipagem no parâmetro e no retorno
    
    function somarinteiros(int $num1, int $num2): int {
        try{
            if (is_int($num1) && is_int($num2)){
                return ($num1 + $num2);
            }else{
                echo("Não é possível realizar o calculo de dois números inteiros, um dos números inseridos não é um número inteiro");
                return 0; //  retornando zero para o int da tipagem de retorno não chorar
            }
        }catch(Throwable $e){
            echo("Aconteceu algum erro aqui: ". $e->getMessage());
            return 0; //  retornando zero para o int da tipagem de retorno não chorar
        }
    }

?>