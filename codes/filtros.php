<?php
    declare(strict_types=1); // sempre colocar na primeira linha para ativar tipagem explícita nesta página!

    // Esse aquivo.php tem como Objetivo Bricar com as filtragems do PHP

    // declarando uma constante com define('NOME_CONSTANTE',$valor);
    define('SITE_NOME','Rick-Trem');
    define('SITE_DESCRIÇÃO','Site criado para zoar com RICK AND MORTY');
    define('URL_PRODUCAO','http://Rick_Morty.com.net');
    define('URL_DESENVOLVIMENTO','http://localhost/');

    // UTILIZANDO CONST PARA CRIAR CONSTANTES

    const SITE_NOME2 = 'Rick_MORTY-trem';

    /**
     * Essa função tem como principal OBJETIVO Validar emails
     * @param string $emial é um parâmetro que rescebe uma string
     * @return bool - Devolve um valor boolean indicando se foi válido ou não
     */
    function validarEmail(string $email):bool{
        
        if (is_string($email)){
            filter_var($email,FILTER_VALIDATE_EMAIL);
            return true;
        }else{
            return false;
        }        
    };

    /**
     * Essa função tem como principal OBJETIVO Validar URL´s
     * @param string $emial é um parâmetro que rescebe uma string
     * @return bool - Devolve um valor boolean indicando se foi válido ou não
     */
    function validarUrl(string $url):bool{
        
        if(is_string($url)){
            filter_var($url,FILTER_VALIDATE_URL);
            return true;
        }else{
            return false;
        }
    }

    /**
     * Essa função tem como principal OBJETIVO Validar URL´s a diferença é que ela é personalizada
     * @param string $emial é um parâmetro que rescebe uma string
     * @return bool - Devolve um valor boolean indicando se foi válido ou não
     */
        function validarUrlPersonalizada(string $url=URL_PRODUCAO):bool{
        try{
            if (is_string($url)){
                if(mb_strlen($url) < 10 ){
                    return false;
                }elseif(!str_contains($url,'.')){ // o caracter ! na função, dentro da condição if, nega a codição, é um forma de NOT, operador lógico
                    return false;
                }elseif((str_contains($url, 'http://') || str_contains($url, 'https://'))){
                    return true;
                }else{
                    return false;      
                };
            }else{
                echo'URL não é válida!';
                return false;
            }
        }catch(Throwable $e ){
            echo "Aconteceu alguma cagada aqui MORTY! " . $e->getMessage();
            return false; // para o retorno da função para de chorar
        }
    }
?>