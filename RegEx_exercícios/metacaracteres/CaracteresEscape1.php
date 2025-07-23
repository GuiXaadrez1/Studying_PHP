<?php

    declare(strict_types=1); // realizando declaração explícita

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // o objetivo deste arquivo é mostrar os caracteres de escape

    // \d -> Metacaracter que significa: Qualquer número de 0 a 9
    // \s -> Metacaracter que significa: Espaço,TAB, etc...

    /* lembrando que podemos combinar metacaracteres com operadores literais, exemplo para telefones:
        
        "-\d\d\d5"
        
        isso significa: 
            O hífen indica que o padrão de caracteres deve começar com um hífen literal
            \d ré um Metacaracter que representa qualquer número de 0 a 9
            \d\d\d combinação de Três \d seguidos, indicando três dígitos numéricos em sequência, exemplo: (-465)
            O 5 literal indica que o padrão termina com o número 5.

        Resumindo:

            A expressão -\d\d\d5 corresponde a qualquer substring que:

                Comece com um hífen (-)

                Tenha três dígitos seguidos depois do hífen

                E termine com o dígito 5
    */

    // vamos aprender a usar os metascaracteres de escape e utilizar a função nativa preg_match_all + foreach 
    // lembre-se de pegar o lembrete descrito acima como exemplo para essa atividade!

    $telefones = [
        "(11) 91234-5678",
        "(21) 99876-5432",
        "(31) 98765-4321",
        "(41) 91234-5678",
        "(51) 97654-3210",
        "(61) 98765-4321",
        "(71) 91234-5678",
        "(81) 99876-5432",
        "(91) 97654-3210",
        "(85) 98765-4321"
    ];    

    /**
     * Essa função fazemos uma filtragem com Regex para retornar todos os telefones com 0 no final
     * @param array $objeto, basicamente rescebemoos o nosso array com todos os telefones
     * @return string - Retornamos 
    */
    
    function operador_escape(array $objeto):string{
        
        try{ 
            
            // criando um array vazio
            $telefones_desejados = [];
            
            // usando um foreach para percorrer em um array
            foreach($objeto as $elementos){

                # usando delimitador // com repetiçaõ de metacaracteras {} e metacaractere Escape \d para numeros e \s para espaço
                $pattern = '/\((\d{2})\)\s\d{5}-\d{3}0/';

                /*
                    Traduzinhdo o Regex

                    | Parte     | Significado                                                                                                         |
                    | --------- | ------------------------------------------------------------------------------------------------------------------- |
                    | `/.../`   | Delimitadores do padrão regex em PHP — obrigatório.                                                                 |
                    | `\(`      | **Abre parênteses literal**. O `\` faz o `(` ser interpretado como **caractere normal**, não como grupo de captura. |
                    | `(\d{2})` | **Grupo de captura #1** → casa **dois dígitos** (o DDD).                                                            |
                    | `\)`      | **Fecha parênteses literal**.                                                                                       |
                    | `\s`      | **Um caractere de espaço em branco** (espaço, tab, etc).                                                            |
                    | `\d{5}`   | Casa **cinco dígitos seguidos** (parte principal do número).                                                        |
                    | `-`       | Um **hífen literal**.                                                                                               |
                    | `\d{3}`   | Casa **três dígitos seguidos** (primeiros 3 do sufixo).                                                             |
                    | `0`       | O número **zero literal**, no final.                                                                                |                
                
                */

                preg_match_all($pattern, $elementos, $matches);
                
                /*
                    $matches é um array de saída que o PHP preenche automaticamente quando encontra 
                    padrões que batem com a sua regex.
                */

                if(isset($matches[0][0])){
                    $telefones_desejados[] = $matches[0][0]; // estamos adicionando ao final do Array é a mesma coisa com o método array_push();
                    /*
                        Como estamos trabalhando com um array bidimensional ou multidimensional
                        acessar O primeiro índice ([1]) indica qual grupo.
                        acessar O segundo índice ([0]) indica qual ocorrência dentro da string.

                    */
                    
                    // isset() é um método que verifica se uma variável foi definida e se o valor dela não é null
                };
    
            };


            return implode(', ', $telefones_desejados);

            /*
                implode() é uma função nativa do PHP para juntar os elementos de um array em uma única string,
                usando um separador que você define.

                sintaxe: implode(string $glue, array $pieces): string

                $glue → O separador, ou seja, o texto que vai aparecer entre os elementos.

                $pieces → O array cujos elementos você quer juntar.
            */

        }catch(Throwable $e){   

            return "Error: " . $e->getMessage();
        };
    };

    echo operador_escape($telefones);

    //var_dump(operador_escape($telefones));


/*
    OBSERVAÇÕES IMPORTANTES!!!!


    Contexto: Como funciona o $matches em preg_match_all
        
        Quando você usa preg_match_all($pattern, $subject, $matches), o PHP preenche a variável $matches com um array multidimensional
        que contém os resultados da busca da expressão regular.

    Estrutura básica do $matches

        $matches[0] → contém todos os textos que casaram com o padrão inteiro (a regex completa).

        $matches[1] → contém todos os textos que casaram com o primeiro grupo de captura (o primeiro conjunto de parênteses () da regex).

        $matches[2] → contém todos os textos que casaram com o segundo grupo de captura, e assim por diante...

    O que significa o índice interno [0]

        Cada um desses arrays pode conter múltiplas ocorrências (casos onde a regex bateu várias vezes no texto).

        $matches[0][0] → a primeira ocorrência do texto que casou com o padrão completo.

        $matches[0][1] → a segunda ocorrência do texto completo.

        $matches[1][0] → a primeira ocorrência do texto que casou com o primeiro grupo de captura.

        $matches[1][1] → a segunda ocorrência do texto que casou com o primeiro grupo de captura
*/
?>


