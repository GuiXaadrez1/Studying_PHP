<?php
    
    // definindo tipagem explícita, ajuda a evitar bugs silenciosos
    declare(strict_types=1);
    
    // Esse script PHP tem como principal objetivo, trabalhar um pouco com arrays, funções, métodos, iteração e etc...
    // Arrays tem um vasto conteúdo, segue um link para um guia: https://github.com/GuiXaadrez1/Studying_PHP/blob/main/doc/2%20-%20notas/12%20-%20Arrays_PHP.md

    echo("<p>Abaixo estamos usando o var_dump para acessar informações mais completas da variável super global  $ _SERVER' </p><hr>");
    var_dump($_SERVER); 

    echo("<hr><br>var_dump é um método nativo que nos permite debugar uma variável ou função de modo mais completo que o print_r<br>
        ele retorna void ou mixed, ou seja, pode ser qualquer valor ou mais.<br>
        Veja que nosso var_dum indicar que a variável super global $ _SERVER é uma array com 49 índicies<hr>"
    );

    echo("<p>a variável super global $ _Server é uma variável que na verdade comporta um ARRAY</p>");
    echo("a melhor forma de acessar uma propriedade, item, elemento de uma super global como o $ _SERVER é utilizando filtros<br>Como vimos no código fonte do InfoServer.php: <a href = 'http://localhost/Studying_PHP/codes/InfoServer.php'>Clique aqui para voltar<a/><br>");
    echo("porém podemos acessar diretamente pelo índicie numérico ou assossiativo (não é muito recomendado fazer isso nas variáveis super globais a não ser para fins didáticos)");
    echo("<br>Abaixo teremos manipulação de Arrays no nosso código fonte<hr>");

    //Acessando diretamente com um índicie associativo do nosso $_SERVER
    echo $_SERVER['SERVER_NAME'] . " - Nome do nosso server local";
    echo "<br>". $_SERVER['SERVER_ADMIN'] . " - Nome do admin deste Servidor";
    echo "<br>". $_SERVER['HTTP_HOST'] . " - HTTP_HOST";
    echo("<br><hr> Abaixo vão ser outros Arrays que iremos criar <hr>");

    # formas de criar arrays 
    
    // $meses = []; usando apenas colchetes "prefiro este"  
    // $ meses = array([]); usando casting 
    $meses = [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril'
    ]; # array unidimencional homogêneo em linguagnes de baixo nível como C isso é um VETOR
    
    var_dump($meses); # usando var_dump para obter: qunatidade de elementos, qunatidade de caracteres que a string tem e o index deste elemento

    echo"<hr>";
    $numéros = [
        1,
        2,
        3,
        4,
        5,
        6
    ]; # array unidimencional homogêneo de inteiros
    var_dump($numéros);

    # podemos definir manualmente o indicíe de um array, seja um indicie numerico ou assossiativo

    echo"<hr>";
    $valores = [
        3 =>1.5,
        2 => 2.85,
        1 => 4.55,
        'j'=>7.0, # esse indicie assossiativo é meramente informativo
    ];
    var_dump($valores);

    echo("<hr><p> Abaixo estamos percorrendo um array, tanto pelo indicie assossiativo como pelo indicie numérico </p><hr>");

    // percorrendo, iterando sobre um array usando foreach
    foreach($meses as $mes){
        echo $mes ."<br>";
    };

     echo("<br>");

    // percorrendo, iterando sobre um array usando foreach so que puxando o indicie do elemento
    foreach($meses as $index => $mes){
        echo $index ."<br>";
    };

    // criando uma função que retorne uma string formatada contendo o dia da semana, dia do mês, o nome do mês, o ano e as horas,  utilizando Array para dia da semana e mês
    // exemplo: terça-feira, 15 de julho de 2025

    function dataAtual():string{
        try{

            // Colocando o Fuso Horário de São Paulo
            date_default_timezone_set('America/Sao_Paulo');
            
            $diaMes = date('j'); # Dia do mês sem zero à esquerda (1 a 31)
            $diaSemana = date('w'); // Dia da semana numérico (0 = domingo, 6 = sábado)
            $mesAtual = date('n') -1;  // Mês numérico sem zero à esquerda
            $ano = date('Y'); // Ano com 4 dígitos

            $diasSemana = [
                'domingo',      // 0
                'segunda-feira',// 1
                'terca-feira',  // 2
                'quarta-feira', // 3
                'quinta-feira', // 4
                'sexta-feira',  // 5
                'sabado'        // 6
            ];

            $nomeMesAno = [
                'janeiro', // 0
                'fevereiro', // 1
                'março', // 2
                'abril', // 3
                'maio', // 4
                'junho', // 5
                'julho', // 6
                'agosto', // 7
                'setembro', // 8 
                'outubro', // 9
                'novembro', // 10
                'dezembro' // 11
            ];

            # fazendo vinculação pelo indicie assossiativo
            $dataFormatada = $diasSemana[$diaSemana] . ", ". $diaMes . " de " . $nomeMesAno[$mesAtual] . " de " . $ano . "<br>" . "Horas: " . date('H:i');

            return $dataFormatada;

        }catch(Throwable $e){
            return "Aconteceu algum erro aqui: " . $e -> getMessage();
        }
    };

    echo dataAtual();

?>