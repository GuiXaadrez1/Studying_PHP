<?php
    
    // Aqui basicamente vai entrar a nossa tabela verdade do racicíonio lógico
    // Basicamente vamos ter uma matématica booleana aqui

    // Operador Lógico OU no Regex -> |
    // OU == OR == |

    // exemplo de Expressão Regular: /<p>(Primeiro)|(Segundo)|(Terceiro).Parágrafo<\/p>/

    /*
        Estamos fazendo o seguinte: 
            Selecione os parágrafos de html que  contém <p> Primeiro ou Segundo ou Terceiro
            e qualquler conjunto de caracters inclusive os espaços posteriores a ele e 
            o final de liretalmente ser Parágrafo<\p>    
    */

    /*  Abaixo vai uma tabela com uma classe de Metacaracteres que podem servir 
        para negação de valores lógicos

        | Sintaxe | Significado                                | Exemplo                       |
        |---------|--------------------------------------------|-------------------------------|
        | `[^abc]`| Qualquer caractere **exceto** `a`, `b`, `c`| `[^0-9]` → não dígito         |
        | `\D`    | Qualquer caractere que não seja dígito     | `\D+` → "abc", "-"            |
        | `\w`    | Palavra: `[A-Za-z0-9_]`                    | `\w+` → "word123", "_var"     |
        | `\W`    | Qualquer caractere não palavra             | `\W+` → "!", " "              |
        | `\S`    | Qualquer caractere não espaço              | `\S+` → "abc", "123"          |
    */
    
    // Exercício! Crie uma função que dado 
    // um conjunto de Caracteres, retorne as palavras: Rato, Rei, Rainha


    function palavras_filtradas(string $texto):string{
        try{
            if(is_string($texto)){
                $resultado = preg_match_all("/(Rato)|(rato)|(Rei)|(rei)|(Rainha)|(rainha)/",$texto,$matches);

                return "Foram achados: " . (string) $resultado ." Ocorrências que são: <br>" . implode(', ',$matches[0]);
            }else{
                return "Não foi possível retornar as palavras Rato, Rei, Rainha";
            }
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        };
    };

    $texto = "rato, Rato, Rei, Rainha, Rainha, rato, rei, rei, rainha, okaodjoodjoajd";

    echo palavras_filtradas($texto);

?>