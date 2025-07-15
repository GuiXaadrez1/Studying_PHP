<?php
    declare(strict_types=1); // deixando tipagem explícita! Melhor para evitar erros silenciosos
    include_once 'filtros.php';// pegar nossas constatantes

    // Vamos puxar informações de uma variável super global, essa variáveis são variáveis padrão que podem ser
    // acessadas durante todo o escopo do projeto, ou seja, em qualquer lugar do código, resumidamente falando

    // variável super global $_SERVER para obter iinformações

    var_dump($_SERVER);


    /**
     * Essa função apenas tem como objetivo verificar, validar se o nosso servidor é localhost
     * @return bool
     */
    function filter_input_localhost():bool{

        try{
            $servidor = filter_input(INPUT_SERVER,'SERVER_NAME',FILTER_DEFAULT);

            if($servidor=='localhost'){
                return true;
            }else{
                return false;
            }
        }catch(Throwable $e){
            echo'Aconteceu alguma cagada aqui ' .$e->getMessage();
            return false;
        }

    };

    echo "<hr>O servidor é local host? " . "<br> O resultado é: " . filter_input_localhost() . " Se apareceu '1' é porque é verdadeiro <hr>";

    /**
     *  forma da vídeo aula, craindo uma url para localhost ou desenvolvimento
     * @param string $url, colocamos um caminho de rota aqui
     * @return string - retorna uma string formatada com o caminho completo, dependendo do servidor, se for  local ou não
     * 
     */
    function url(string $caminho_rota ):string{
        $servidor = filter_input(INPUT_SERVER,'SERVER_NAME');
        $ambiente = ($servidor=='localhost'? URL_DESENVOLVIMENTO: URL_PRODUCAO);
        return $ambiente . $caminho_rota;
    }; 

    echo url("rick_admin". "<hr>");

    // forma que eu pretendo fazer usando constante na url e a função de validação de server, basicamente vai ser a mesma coisa acima só que um pouco diferente

    function url_server_rote(string $caminho_rota):string{
        try{
           if(is_string($caminho_rota)){

                if (filter_input_localhost() == true){
                    $ambiente = URL_DESENVOLVIMENTO;
                    return $ambiente . $caminho_rota;
                }else{
                    $ambiente = URL_PRODUCAO;
                    return $ambiente . $caminho_rota;
                }
           }else{
                return "Não foi possível acessar essa Rota! Tente novamente.";
            };
        }catch(Throwable $e){
            return "Aconteceu alguma cagada aqui: " .$e->getMessage();
        }   
    };

    echo url_server_rote($caminho_rota='Evil_Morty_admin') . "<hr>";

?>