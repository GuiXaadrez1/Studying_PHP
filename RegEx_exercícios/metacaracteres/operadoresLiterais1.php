<?php

    // deixando tipagem explícita!
    declare(strict_types=1);

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // O objetivo deste arquivo.php é usar as funções nativas que facilitam manipulação com Regex
    // também tem o objetivo de realizar e entender formas de expressões regulares e seus metacaracteres
    
    // Primeiro que vamos aprender são os metacaracteres literais

    // Basicamente estamos criando um expressão regular que busca literalmente e igualmente a forma como aquele texto está escrito
    // ou seja, operadores literais são Case Sensivity

    $string1 = "Olá mundo";
    $string2 = "ola mundo";
    $string3 = "OLÁ MUNDO";
    $string4 = "Bla bla Car";
    $string5 = "bla bla car";

    function operador_literal(string $buscar_string):string{
        try{

            $pattern = '/'. $buscar_string .'/'; # essa variável vai representar o parâmetro $pattern, basicamente é a nossa expressão_regular 
            
            // $subject = $buscar_string; # Essa variável vai representar o parâmetro $subject, basicamente é string que contém o texto de entrada para ser validado pelo regex

            // prag_match é a função nativa realiza uma correspondência com expressão regular
            // ela retorna int, ou seja a quantidade de correspodência que ela achou nesta string
            // retorna false quando não ache nem uma correspodência, 

            $regexMetaCaracterLiteral = preg_match($pattern, $buscar_string);

            if($regexMetaCaracterLiteral >= 1){

                // usando casting para converter de int ou bool, explícitamente para string
            
                return "Foi encontrado: ". (string) $regexMetaCaracterLiteral ." correspodência(s)";
            
            }elseif($regexMetaCaracterLiteral == false ){

                return "Foi encontrado nenhuma correspodência.";

            }else{
                return "Eu não sei o que aconteceu. ";
            };
        }catch(Throwable $e){
            return "Error: " . $e-> getMessage();
       }
    }

    echo operador_literal($string1) . "<hr>";
    echo operador_literal($string2) . "<hr>";
    echo operador_literal($string3) . "<hr>";
    echo operador_literal($string4) . "<hr>";
    echo operador_literal($string5) . "<hr>";
?>

<DOCTYPE! html>
<html>
    <head>
        <meta charset="UTF-8"> <!-- Define a codificação de caracteres para dar suporte ao pt-br -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Deixa responsivo em mobile -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Força compatibilidade Edge no IE -->
    </head>
    <body>
        <h1>Atenção Morty!</h1>
        <p>Muitos editores de texto são Case insensitive, porém ao usarmos operadores literais no Regex</p>
        <p>eles vão interpretar como se fossem Case sensitive, mas por baixo dos panos, o editor esta transformando o operador literal em metacacteres</p>
        <p>Bem a grosso modo, esses metacaracteres são um array de caracteresque que ficam fazendo comparações com aquela string, conjunto de caracteres, pela posição do seu indicie e valores</p>
        <p>TENHA CUIDADO ao apenas usar operador literal ou metacaracter literal.</p>
        <p>Porque se aparecer algum caracter com sintaxe especial para sua função do php preg_match($pattern,$subject)</p>
        <p>Pode dar uma zica!</p>
        <p>preg_match executa uma varredura na $subject (sua string de entrada) para tentar casar (matching) o padrão $pattern.</p>
        <ul>
            <li>Se o padrão Regex bater em qualquer trecho da $subject, retorna 1.</li>
            <li>Se não bater em nada, retorna 0.</li>
            <li>Se o padrão for inválido, retorna FALSE.</li>
        </ul>
        <b><p>Se quiser tratar tudo como se fosse um caracter literal, use a função nativa: preg_quote($buscar_string, '/')</p></b>
        <h3>Metacaracteres que afetam <code>preg_match()</code> no PHP:</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Metacaractere</th>
                    <th>Descrição</th>
                    <th>Significado</th>
                    <th>Exemplo de Padrão</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>.</code></td>
                    <td>Ponto</td>
                    <td>Corresponde a **qualquer caractere único** (exceto nova linha)</td>
                    <td><code>/a.c/</code> casa <code>abc</code>, <code>axc</code></td>
                    <td>Para casar o ponto literal, use <code>\.</code></td>
                </tr>
                <tr>
                    <td><code>^</code></td>
                    <td>Circunflexo</td>
                    <td>Âncora de início da string</td>
                    <td><code>/^abc/</code> casa se começar com <code>abc</code></td>
                    <td>Dentro de <code>[]</code> inverte a classe</td>
                </tr>
                <tr>
                    <td><code>$</code></td>
                    <td>Cifrão</td>
                    <td>Âncora de fim da string</td>
                    <td><code>/abc$/</code> casa se terminar com <code>abc</code></td>
                    <td>Para cifrão literal, use <code>\$</code></td>
                </tr>
                <tr>
                    <td><code>*</code></td>
                    <td>Asterisco</td>
                    <td>0 ou mais repetições</td>
                    <td><code>/a*/</code> casa "", "a", "aaa"</td>
                    <td>Use <code>\*</code> para literal</td>
                </tr>
                <tr>
                    <td><code>+</code></td>
                    <td>Mais</td>
                    <td>1 ou mais repetições</td>
                    <td><code>/a+/</code> casa "a", "aaa"</td>
                    <td>Use <code>\+</code> para literal</td>
                </tr>
                <tr>
                    <td><code>?</code></td>
                    <td>Interrogação</td>
                    <td>0 ou 1 ocorrência (opcional)</td>
                    <td><code>/a?/</code> casa "" ou "a"</td>
                    <td>Use <code>\?</code> para literal</td>
                </tr>
                <tr>
                    <td><code>[]</code></td>
                    <td>Colchetes</td>
                    <td>Classe de caracteres</td>
                    <td><code>/[abc]/</code> casa "a", "b", ou "c"</td>
                    <td>Para colchete literal, use <code>\[</code> e <code>\]</code></td>
                </tr>
                <tr>
                    <td><code>()</code></td>
                    <td>Parênteses</td>
                    <td>Grupo de captura</td>
                    <td><code>/(abc)/</code> captura "abc"</td>
                    <td>Para parêntese literal, use <code>\(</code> e <code>\)</code></td>
                </tr>
                <tr>
                    <td><code>{}</code></td>
                    <td>Chaves</td>
                    <td>Quantificador</td>
                    <td><code>/a{3}/</code> casa "aaa"</td>
                    <td>Para literal: <code>\{</code> e <code>\}</code></td>
                </tr>
                <tr>
                    <td><code>|</code></td>
                    <td>Pipe</td>
                    <td>OU lógico</td>
                    <td><code>/a|b/</code> casa "a" ou "b"</td>
                    <td>Para literal, use <code>\|</code></td>
                </tr>
                <tr>
                    <td><code>\</code></td>
                    <td>Barra invertida</td>
                    <td>Escape</td>
                    <td><code>/\d/</code> casa dígito</td>
                    <td>Para barra literal, duplique: <code>\\</code></td>
                </tr>
                <tr>
                    <td><code>/</code></td>
                    <td>Delimitador padrão</td>
                    <td>Marca início/fim do Regex</td>
                    <td><code>/abc/</code></td>
                    <td>Se usar dentro do padrão, escape com <code>\/</code> ou troque delimitador</td>
                </tr>
            </tbody>
        </table>

    </body>
<html>