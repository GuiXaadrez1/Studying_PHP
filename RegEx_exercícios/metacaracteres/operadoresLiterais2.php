<?php
    declare(strict_types=1);

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // Principais simbolos dos Metas Caracteres, não são literais, mas controlam
    // o comportamente do literais.

    // alguns simbólos como: ponto final "." , sifrão "$" tem significados especíais dentro do Regex
    // Isso pode comprometer o comportamento dodos operadores literias

    // para esses simbolos serem buscados, eles vão precisar dos caracteres de escape para serem buscados

    /*
        Exemplo: 
        . -> dentro do Regex significa literalmente qualquer caracter
        $ -> dentro do Regex significa Fim da string
    
    */

    /*
        Para Resolver isso, utilizamos o nosso Meta Caracter de Escape \ para achar esse Meta Caractere Especial
        Exemplo:

        /\. / -> \. utilizando operador de escape para achar o ponto final

        /\*   / -> \* utilizando operador de escape para achar o asteristico
        / \( / ->  utilizando operador de escape para achar a abertura do parenteses 
        / \) / -> utilizando operador de escape para achar a fechadura do parenteses

        assim por diante...

        observaçõo: /.../ são o nosso  delimitadores, eles delimitam o quq queremos expressar com Regex
    */

    // MISSÃO CRIAR FUNÇÕES PARA RETORNAR ponto final, Cifrão, (), {}, *, /, []

    $texto1 = "O rato. Roeu. A roupa. Do Rei. De Roma.";
    $texto1_1 = "O rato* Roeu* A roupa* Do Rei* De Roma*";

    function filtrando_ponto_final(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\.)/';
                
                # fazendo a nossa filtragem com Regex utilizando preg_match_all para capturar todos os pontos
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_pontos = implode('; ', $matches[0]);
                    return "Pontos encontrados: " .$todos_pontos;
                }else{
                    return "Nenhum ponto final encontrado!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
            /*
                A flechinha -> no PHP faz o mesmo papel do ponto . em linguagens orientadas a objetos como Java, TypeScript, Python e JavaScript.
                Ou seja, usamos essa flechinha para acessar um atributo ou método específico de um Objeto php
            */
        };
    };

    echo filtrando_ponto_final($texto1) . "<hr>";

    echo filtrando_ponto_final($texto1_1);


    function filtrando_Asterisco(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\*)/';
                
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_Asterisco= implode('; ', $matches[0]);
                    return "Asteriscos encontrados: " .$todos_Asterisco;
                }else{
                    return "Nenhum Asterisco encontrado!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        };
    };


    $texto2 = "***...***...-955";
    $texto2_1 = "$$$...$$$...-955";

    echo "<hr>" . filtrando_Asterisco($texto2);
    echo "<hr>" . filtrando_Asterisco($texto2_1);

    function filtrando_Cifão(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\$)/';
                
                # fazendo a nossa filtragem com Regex utilizando preg_match_all para capturar todos os pontos
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_Cifroes = implode('; ', $matches[0]);
                    return "Cifrões encontrados: " .$todos_Cifroes;
                }else{
                    return "Nenhum Cifrão encontrado!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
            /*
                A flechinha -> no PHP faz o mesmo papel do ponto . em linguagens orientadas a objetos como Java, TypeScript, Python e JavaScript.
                Ou seja, usamos essa flechinha para acessar um atributo ou método específico de um Objeto php
            */
        };
    };

    $texto3 = "50$,40$,60$";
    $texto3_1 = "Tem namorada?";
    echo "<hr>" . filtrando_Cifão($texto3);
    echo "<hr>" . filtrando_Cifão($texto3_1);

    function filtrando_Parenteses(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\(\))/'; # este vai achar apenas os parenteses que estiverem Vazios

                # existe essa forma também, mas será necessário, posteriormente usar a função: preg_replace($regex, '()', $texto);
                //$regex = \((.*?)\)
                
                # fazendo a nossa filtragem com Regex utilizando preg_match_all para capturar todos os pontos
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_Parenteses = implode('; ', $matches[0]);
                    return "Parênteses encontrados: " .$todos_Parenteses;
                }else{
                    return "Nenhum Parênteses encontrado!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
            /*
                A flechinha -> no PHP faz o mesmo papel do ponto . em linguagens orientadas a objetos como Java, TypeScript, Python e JavaScript.
                Ou seja, usamos essa flechinha para acessar um atributo ou método específico de um Objeto php
            */
        };
    };
    
    $texto4 = "()50$(),40$(),(60$)()";
    $texto4_1 = "Tem namorada???????";
    echo "<hr>" . filtrando_Parenteses($texto4);
    echo "<hr>" . filtrando_Parenteses($texto4_1);

    function filtrando_Colchetes(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\[\])/'; # este vai achar apenas os parenteses que estiverem Vazios

                # existe essa forma também, mas será necessário, posteriormente usar a função: preg_replace($regex, '()', $texto);
                //$regex = \([.*?]\)
                
                # fazendo a nossa filtragem com Regex utilizando preg_match_all para capturar todos os pontos
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_Colchetes = implode('; ', $matches[0]);
                    return "Colchetes encontrados: " .$todos_Colchetes;
                }else{
                    return "Nenhum Colchete encontrado!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
            /*
                A flechinha -> no PHP faz o mesmo papel do ponto . em linguagens orientadas a objetos como Java, TypeScript, Python e JavaScript.
                Ou seja, usamos essa flechinha para acessar um atributo ou método específico de um Objeto php
            */
        };
    };

    $texto5 = "[][][][][]()50$[][][][](),[]40$(),[](60$)()[]";
    $texto5_1 = "Tem namorada[()()()()]???????";
    echo "<hr>" . filtrando_Colchetes($texto5);
    echo "<hr>" . filtrando_Colchetes($texto5_1);
    

    function filtrando_Chaves(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\{\})/'; # este vai achar apenas os parenteses que estiverem Vazios

                # existe essa forma também, mas será necessário, posteriormente usar a função: preg_replace($regex, '()', $texto);
                //$regex = \({.*?}\)
                
                # fazendo a nossa filtragem com Regex utilizando preg_match_all para capturar todos os pontos
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_Chaves = implode('; ', $matches[0]);
                    return "Chaves encontrados: " .$todos_Chaves;
                }else{
                    return "Nenhuma Chave encontrada!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
            /*
                A flechinha -> no PHP faz o mesmo papel do ponto . em linguagens orientadas a objetos como Java, TypeScript, Python e JavaScript.
                Ou seja, usamos essa flechinha para acessar um atributo ou método específico de um Objeto php
            */
        };
    };


    $texto6 = "{}[]{}[{}]{[{}]}[{}][{}]{}()50$[{}]{}{}[][][](),[]40$(),[](60$)()[]";
    $texto6_1 = "Tem namorado{[()()()()]???????}";
    echo "<hr>" . filtrando_Chaves($texto6);
    echo "<hr>" . filtrando_Chaves($texto6_1);


    function filtrando_Barra(string $texto):string{
        try{

            $validacao_texto = is_string($texto)?true:false;

            if($validacao_texto == true){
                
                # usando um grupo de captura para capturar todos os pontos finais do texto
                $regex='/(\/)/'; # este vai achar apenas os parenteses que estiverem Vazios

                # existe essa forma também, mas será necessário, posteriormente usar a função: preg_replace($regex, '()', $texto);
                //$regex = \({.*?}\)
                
                # fazendo a nossa filtragem com Regex utilizando preg_match_all para capturar todos os pontos
                preg_match_all($regex,$texto,$matches);

                if(isset($matches[0]) && !empty($matches[0])){  
                    $todos_Chaves = implode('; ', $matches[0]);
                    return "Barras encontrados: " .$todos_Chaves;
                }else{
                    return "Nenhuma Barra encontrada!";
                };
            }else{
                return "Não foi possível realizar a filtragem!";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
            /*
                A flechinha -> no PHP faz o mesmo papel do ponto . em linguagens orientadas a objetos como Java, TypeScript, Python e JavaScript.
                Ou seja, usamos essa flechinha para acessar um atributo ou método específico de um Objeto php
            */
        };
    };

    $texto7 = "{}/[]/{}/[{/}]/{[{/}]/}/[/{}/]/[/{}/]/{}/(/)/50/$[{/}/]/{/}/{}/[/]/[][](),[]4/0$/(),[](60$)()[]";
    $texto7_1 = "_________________Tem namorado{[()()()()]???????}";
    echo "<hr>" . filtrando_Barra($texto7);
    echo "<hr>" . filtrando_Barra($texto7_1);
?>