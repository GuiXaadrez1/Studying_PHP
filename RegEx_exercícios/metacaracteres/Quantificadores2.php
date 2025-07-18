<?php
    // ativando tipagem explícita! 
    declare(strict_types=1);

    // Explicação Específicas de Quantificadores

    // também chamados de quantificadores! 
    // {} -> Chaves são os nossos quantificadores
    // eles determinam a quantificação dos nossos metacaracteres genéricos (literais)!
    // exemplo: /^[A-Z][a-z]{5}\.$/ -> _ _ _ _ _ _ . -> Brasil. 

    // exemplo2: /^[A-Z][a-z]{3,7}\.$/


    // {n,espaço_vazio} -> (mínimo, sem_valor_máximo_pode_ser_qualquer_qauntidade) -> /\d{2,}/
    // {n,m} -> (mínimo,máximo) -> Quando você ver esse quantificador com uma determinada quantidade, depois uma vírgula 
    // outra determiando quantidade, estamos falando o seguinte -> Repita o padrão anterior pelo menos 3 vezes e no máximo 7 vezes.

    /*
        exemplos de casos válidos e inválidos


        bc ✅ (3 letras)

        abcdefg ✅ (7 letras)

        abcd ✅ (4 letras)

        ab ❌ (só 2 letras, mínimo é 3)
    
    */

    // TRADUÇÃO -> A string deve começar com uma letra maiúscula, seguida de exatamente cinco letras minúsculas, terminando com um ponto final
    
    /*
        TABELA DOS SIMBOLOS: 

        | Padrão     | Significado                                                         |
        | ---------- | ------------------------------------------------------------------- |
        | `/.../`    | Delimita a expressão regular (sintaxe de regex)                     |
        | `^`        | Âncora de início da string                                          |
        | `[A-Z]`    | Um **único caractere maiúsculo** (de A a Z)                         |
        | `[a-z]{5}` | Exatamente **cinco letras minúsculas** (de a a z)                   |
        | `\.`       | Um **ponto literal** (o `\` escapa o `.` para que não seja coringa) |
        | `$`        | Âncora de fim da string                                             |
    
        Observaçãoo o meta caracter \w -> representa todos os caracteres word [A-Za-z0-9_]
    */


    // Qauntificador com o metacaracter ? -> Quantifica 1 ou N ocorrência do caracter
    // Ou seja, o meta caracter ? indicar que um caracter anterior ao dele pode ou não existir

    // exemplo: /colou?r/ 

    // podemos retornar essas duas ocorrência se estiver na string: color, colour


    // Exercício, crie uma função que receba um texto que contenha a palavra você, vocês e retorne as duas ocorrências com o operador ?

    $texto = "Você mijojikjjo mijo me jogou fora! Vocês não entendem a dor de um gagagagagagaggogogogogogogogogogogogogog...";

    function filtrar_vc(string $texto):string{
        try{
            if(is_string($texto)==true){
                
                $regex = "/\wocês?/";
                $resultado = preg_match_all($regex,$texto,$matches);

                return ("Existem " . (string) $resultado) ." ocorrências: " . implode(', ', $matches[0]);

            }else{
                return 'Não foi possível realizar a filtragem.';
            };
        }catch(Throwable $e){   
            return "Error: " . $e->getMessage();
        };
    };

    echo filtrar_vc($texto);
?>