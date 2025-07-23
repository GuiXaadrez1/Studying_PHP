<?php
    // ativando tipagem explícita!
    declare(strict_types=1);

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // O objetivo deste arquivo.php é aprendermos usar negaçoes com Regex

    // Podemos usar o Metacaracter de início ^ dentro de uma Classe de caracteres
    // ou conjunto de caracteres para fazer uma negação, veja! 

    // exemplo: /[^abc]/

    // Aqui colocamos que não é para selecionar onde tem a, b, c

    // Se colocarmos ele fore da classe ou conjunto de caracteres

    // exemplo: /^[abc]/

    // Ele o metacaracter terá a sua função original, de delimitar caracteres
    // que iniciam com a, b, c

    // Podemos até combinar as duas funções deste Meta Caracter ^ que são:
    // delimitar o inicio para aquele caracter específico ou de fazer valo lógico não

    //exemplo: /^[^abc]/

    // acima é o mesmo que: Selecionar todos os caracteres que não começam com a,b,c

    // Exercício, Criar uma função filtre palavras, que não devem possuir a,b,c


    function filtrar_palavra_abc(string $texto ):string{
        try{
            if(is_string($texto)==true){
                $regex = '/[^abc].[^abc]*[^abc]?/';

                $resultado = preg_match_all($regex,$texto,$matches);
                
                if(isset($matches[0]) && !empty($matches[0])){
                    return "Foram achados: " . $resultado . " Ocorrências que são: <br>" . implode('<br>',$matches[0]);
                }else{
                    return "O array de ocorrências está vazio! Verificar o motivo. ";
                };
            }else{
                return "Não foi possível filtrar o texto";
            }
        }catch(Throwable $e){
            return "Error: " . $e -> getMessage();
        };
    };

    $texto = "sdas asefas dasew qw dqwqd wqaQ auudq wqdqw";
    echo filtrar_palavra_abc($texto);
?>