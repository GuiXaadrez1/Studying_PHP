<?php
    // ativando tipagem explícita!
    declare(strict_types=1);

    // Neste arquivo aprender os metas caracteres especeis: 
    // que são marcadores para iníco e fim de linha (ajuda na identificação de ocorrências)
    // vamos aprender sobre o meta caracter geral para letras!


    // o símbolo da potência ou acento circunflexo significa iníco de linha (^) 
    // ele determina que todos os elementos usados na expressão regular, iniciem de cada parágrafo e só no ínicio de cada parágrafo
    // exemplo: /^Php/ -> Aqui o regex vai retornar todos os parágrafos que iniciam com Php
    // Não esqueça que operadores literais são "Case Sensivity"


    // Cifrão é o meta caractere especial que indica o fim da linha ($)
    // ele determina e restringe a nossa busca para o final de todos os elementos usados na expressão regular de cada parágrafo
    // exemplo: /\.$/ -> Aqui o regex vai retornar todos os parágrafos que terminam com ponto final  (A string deve terminar com ponto final)

    // Classes de caracteres ( ou Grupo de Caracteres)
    // Uma classe de caracteres define um conjunto de possíveis caracteres que uma posição na string pode ter, lembrando que é nesta posição! _ _ _ _ 
    // Exemplo: /^[a-z]\.$/ -> Significa A string deve começar com uma letra minúscula (a–z), 
    // seguida imediatamente por um ponto final, e terminar logo depois disso. para serem retornados pelo nosso Regex.
    // abaixo vai uma tabela com nossas Classes de caractres
    
    /*
    
        | Sintaxe | Significado                                | Exemplo                       |
        |---------|--------------------------------------------|-------------------------------|
        | `[abc]` | Um único `a`, `b` ou `c`                   | `b[aeiou]t` → bat, bet, bit   |
        | `[^abc]`| Qualquer caractere **exceto** `a`, `b`, `c`| `[^0-9]` → não dígito         |
        | `[a-z]` | Letra minúscula de `a` a `z`               | `[a-z]+` → "abc", "xyz"       |
        | `[A-Z]` | Letra maiúscula de `A` a `Z`               | `[A-Z]+` → "ABC", "XYZ"       |
        | `[0-9]` | Dígito de 0 a 9                            | `[0-9]{3}` → "123", "456"     |
        | `\d`    | Atalho para `[0-9]`                        | `\d+` → "2025", "7"           |
        | `\D`    | Qualquer caractere que não seja dígito     | `\D+` → "abc", "-"            |
        | `\w`    | Palavra: `[A-Za-z0-9_]`                    | `\w+` → "word123", "_var"     |
        | `\W`    | Qualquer caractere não palavra             | `\W+` → "!", " "              |
        | `\s`    | Espaço em branco (tab, espaço, nova linha) | `\s+` → " ", "\n", "\t"       |
        | `\S`    | Qualquer caractere não espaço              | `\S+` → "abc", "123"          |
    
    */

    /*  Exercício para o conceito!
        
        Crie uma função que leia uma string e filtre ela com regex! a expressão do regex deve ser:
        A palavra deve começar com Letras maiúscula e terminar com ponto final

    */

    $palavra1 = "Amor.";
    $palavra2 = "Ódio";

    function validar_com_regex($palavra):string{
        try{
            if(is_string($palavra)==true){
                $regex = "/^[A-Z].*\.$/"; // o metacaracter * significa 0 ou mais caracteres
                $resultado = preg_match($regex,$palavra);

                return "Palavra Validada: " . ((string) ($resultado === 1 ? 'true' : 'false'));

            }else{  
                return "Não foi possível validar essa palavra!";
            }
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        };
    };

    echo validar_com_regex($palavra1) . "<hr>";
    echo validar_com_regex($palavra2);


    $textoLongo = <<<TEXT
        Este é o primeiro parágrafo. Ele serve para ilustrar como armazenar blocos de texto extensos em uma única variável no PHP.

        Este é o segundo parágrafo. O heredoc permite que você escreva texto multilinha sem se preocupar com aspas ou concatenação.

        Este é o terceiro parágrafo. Você pode incluir quebras de linha, aspas, apóstrofos e qualquer outro caractere especial sem problemas.

        Este é o quarto parágrafo. Ideal para gerar blocos de Lorem Ipsum, contratos, termos de uso, ou texto dinâmico em páginas HTML.
    TEXT;


    //echo nl2br($textoLongo)

    /*
        nl2br() é uma função nativa do PHP que significa:
        “newline to <br>”
        Ou seja: converte cada \n em <br>, que é a tag de quebra de linha no HTML.
    */

        
    /*  EXERCÍCIO MAIS COMPLEXO!!!

        Usando preg_match_all, encontre todas as palavras que começam com letra maiúsculas e terminam com ponto final.
        Depois, exiba quantas são e liste cada uma.    
    */

    
    function encontrarMaiuscula(string $texto):string{
        try{
            
            $validacao_string = is_string($texto)? true : false;
            
            // Dropei aqui kaakkakakak

            if($validacao_string==true){
                $regex = "/^[A-Z][a-z]+\./";

                $resultado = preg_match_all($regex,$texto,$metches);

                return (string) $resultado;

            }else{
                return "Não foi possível encontrar letras maiúsculas! Tente novamente."; 
            }
        }catch(Throwable $e){
            return "Error " .$e -> getMessage();
        }
    };

    //echo encontrarMaiuscula($textoLongo);

?>