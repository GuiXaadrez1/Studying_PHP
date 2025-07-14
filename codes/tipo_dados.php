<?php 
    #declare(strict_types=1);

    // O objetivo deste script php é colocar os principais tipo de dados e brincar com tipagem de parâmetros, retorno e casting
    // para mais detalhes visite o meu respositório: https://github.com/GuiXaadrez1/Studying_PHP/blob/main/doc/notas/5%20-%20Tipo_Dados_PHP.md

    // "Lembre-se que PHP é fracamente tipado e possui tipagem dinâmica, ele é bem parecido com o javascript e python neste quesito"; 

    # declare(strict_types= 0 | 1) -> Ela ativa o modo de tipagem estrita somente naquele arquivo onde está 
    # Se quiser evitar erros silenciosos com a correção franca, automatica
    # declarar sempre no ínicio de qualquer arquivo.php
    # Regra do PHP: strict_types é LOCAL! NO ARQUIVO LOCAL NÃO SE ESQUEÇA


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
            };
        }catch(Throwable $e){
            echo("Aconteceu algum erro aqui: ". $e->getMessage());
            return 0; //  retornando zero para o int da tipagem de retorno não chorar
        };
    };
    
    function reduzirTexto( string $texto, string $continue = "..."){

        $limite = 120; # vamos permitir apenas 100 caracteres

        # fazendo validação
        try{
            if(is_string($texto)){
                // trim remove espaços no iníco e no fim de uma string
                $textoLimpo = trim(strip_tags($texto)); # a função strip_tags é responsável por remover todas as tags html que vinher do nosso front-end
                $quantidade_string = mb_strlen($textoLimpo);

                # fazendo comparação_vídeo_aula
                /*if($quantidade_string > $limite){
                    $textoResumido = mb_substr($textoLimpo, 0, mb_strpos(mb_substr($textoLimpo, 0, $limite), ' ') ?: $limite);                    
                    $menssagem = "<p>" .$textoResumido . $continue ."</p>";
                    return $menssagem;*/
                
                # meu jeito!
                if($quantidade_string > $limite){
                    $textoResumido = substr($textoLimpo,0,$limite);
                    $menssagem = "<p>" .$textoResumido . $continue ."</p>";
                    return $menssagem;
                }
                else{
                    return "<p>". $textoLimpo . "</p>";
                };
            }
            else{
                echo"<p> Não foio possível carregar o texto, tente novamente! </p>";
            };

        }catch(Throwable $e){
            $erro = $e->getMessage(); 
            return "<p> Aconteceu alguma cagada aqui, Morty, isso é culpa sua!" . $erro . "</p>";
        };

    };

?>