<?php
    // ativando tipagem explicíta!
    declare(strict_types=1);

use function PHPSTORM_META\elementType;

    /* 
        Esse arquivo.php tem como principal objetivo treinar os metas caracteres de escape para espaço: \s
        E também vamos trabalhar com o Metacaracter paraqualquer caractere único é o ponto final ! 
        se colocarmos o ponto final com o Metacaracter de Escape \. -> vamos literalmente achar o ponto final

    */

    // vamos criar uma função  com regex simples que retorne quantas vezes um nucleotídeos G é seguido de um núcleotídeo A três núcleotídeo depois   

    $genoma = "ATGCGTACCGTTAGCGATCCGTAAGCTTAGGCTACGTAGCTAGGCTTACGCTAGCTAGCGTAGCTAGCGTACCGTTAAGCGTACCGCTAGCTAGGTAGCTAGCTAGGTACCGTAGCTAGCTAAGCTAGC";

    /**
     * Essa função fazemos uma contagem seuqência de DNA curtos, buscamos  qualquer fragmento de 4 caracteres que 
     * comece com G, tenha dois caracteres quaisquer no meio e termine com A.
     * Possui exibição de cada sequência na Tela  
     * @param string $seq_genoma 
     * @return - Retorna uma string com o resultado da contagem
    */

    function nucleotideo_seq($seq_genoma):string{
        try{
            
            $validacao_string = is_string($seq_genoma)? true:false;
            if($validacao_string == true){
                
                
                $regex = '/G..A/';
                
                /*
                    Tradução Regex

                    | Padrão | Significado                                                                                                     |
                    | ------ | --------------------------------------------------------------------------------------------------------------- |
                    | **G**  | Casa **literalmente** a letra **G** (Guanina se for contexto DNA).                                              |
                    | **.**  | **Ponto** → Metacaractere que representa **qualquer caractere único**, **exceto nova linha (`\n`)** por padrão. |
                    | **..** | Dois pontos seguidos → representa **dois caracteres quaisquer** consecutivos.                                   |
                    | **A**  | Casa **literalmente** a letra **A** (Adenina no contexto DNA).                                                  |

                
                */

                $resultado = preg_match_all($regex,$seq_genoma,$matches); // vai retornar a quantidades de vezes o padrão de caracter bateu com a expressão regex
                
                echo("Sequências: <br>");

                // iterando o array bidimensional $matches 
                foreach($matches as $coluna){
                    foreach($coluna as $index => $linha){
                        echo((string) "[". $index . "]" . "=>" . $linha . "<br>");
                    };  
                };

                // Usando casting para mudar o tipo de dados da variável resultado explícitamente 
                return "Resultado: " . (string) $resultado;

            }else{
                return "Não foi possível validar a sequeância de nucleotídeos do genoma";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        };
    };
    echo (nucleotideo_seq($genoma));
?>