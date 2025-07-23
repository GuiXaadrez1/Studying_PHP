<?php
    // ativando tipagem explícita no php
    declare(strict_types=1);

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // Vamos trabalhar com o Metacaracter Fominha e Preguiçosa...

    // O meta caracter asteristico * ele vai selecionar todo mundo ou não selecionar
    // desde que aquele caracterer exista! 

    // Basicamente é uma propriedade do Meta Caracter ? 
    // lembre-se que o caracter anterior ao dele pode ou não existir..
    // Mas ele serve também para quebrar linhas em strings...

    // Vamos criar um exemplo: /<p>.*?</p>/

    // lembre-se que o metacaracter . se refere a qualquer caracter naquela posição
    // neste caso, ele é seguido de * e depois ?
    // indicando que podemos ter varias quantidades de caracteres qualquer que pode ou
    // não existir e ser selecionado, retornado pelo nosso Regex

    /* 
        O regex vai entender da seguinte forma:
    
            encontre qualquer trecho de texto que comece com <p>, tenha qualquer 
            conteúdo dentro (inclusive nada) e termine com </p>.
        
            Basicamente um parágrafo html.
    
        Exeplicação detalhada

            Neste Regex basicamente utilizamos operadores literais com  quantificadores
            veja! se tiramor o quantificador ? ele vai misturar parágrafos de html

            retornaria algo assim: <p>...</p>...<p>...</p>...</p>

        Com o Metacaracter ? retorna: 

            <p>...</p>
            <p>...</p>
            <p>...</p>

        Viu qeu retornou algo mais bonito e viável de se avaliar 
    */


    // Exercício! 
    // Crie uma função que resceba um html e retorne apenasa os parágrafos 


    function filtrar_html(string $html):array{
        try{
            $validar_string = is_string($html)? true : false;
            if($validar_string==true){
                
                # não esquecer.. / com algum caracter vai fazer o php entender que essa combinação
                # é um modificador, por isso deu erro

                $regex = '/<p>.*?<\/p>/'; # usando o meso Regex para facilitar o entendimento!
                
                # usando função nativa que utiliza Regex e retorna a quantidades de ocorrências e um array
                preg_match_all($regex,$html,$matches); 
                $resultado = $matches[0];

                return $resultado;

            }else{
               return (array) ("String de Caracteres inválida!");
            }
        }catch(Throwable $e){
            return (array) ("Error: " . $e->getMessage());
        };
    };

    $html = "
    <DOCTYPE html>
        <html>
            <head><><>
            </head>
            <body>
                <h1>O objetivo aqui é pegar apenas tags de parágrafos</h1>
                <p>Parágrafo1</p>
                <p>Parágrafo2</p>
                <p>Parágrafo3</p>
                <p>Se você está lendo essa mensagem e achou todos os parágrafos, parabéns, deu certo!!!</p>
            </body>
        </html>
    ";

    foreach(filtrar_html($html) as $elemento){
        echo $elemento;
    };

?>
