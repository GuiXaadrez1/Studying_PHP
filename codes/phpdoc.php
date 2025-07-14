<?php
    declare(strict_types=1); // declarando diretiva para deixar tipagem explícita!

    /*  Esse arquivo.php tem como objetivo aprender sobre documentação em PHP
        Lembre-se do DocString do python? Então, nasicamente é a mesma coisa.
        diferente de DocString do Python, chamamos de PHPdoc
        segue o link -> https://phpdoc.org/  (cntrl + click encima para entrar no link)
        para saber mais sobre o PHPdoc
    */

    /*  
        Regra do PHP
        Valores default de parâmetros devem ser constantes literais.
        O interpretador não executa código pra calcular um default na assinatura da função.
    */

    /*
        PHP 8 ou + Possui tipagem para Null então segue a regra! 

        | Situação                    | Forma correta    |
        | --------------------------- | ---------------- |
        | Valor **não pode ser null** | `string $param`  |
        | Valor **pode ser null**     | `?string $param` |

    
    */


    // Abaixo está a sintaxe do nosso PHPdoc e ele tem várias tags uma delas é o @param e o @return

    /**
     * Rescebe e devolve o texto 
     * 
     * @param string $Texto parâmetro que rescebe um texto
     * @return string 
    */

    // VOU FAZER UMA MISTUREBA PARA FICAR TRANQUILEBA! VOCêS QUE LUTEM DESCOBRINDO COMO O INDEX ESTÁ FUNCIONANDO OTÁRIOS!

    function funcaoQualquer(string $Texto = "Comentário que fiz para textar o valor padrão de parâmetro da função") {
        try{
            
            // Se o texto realmente for uma string, retornar esse texto
            if ( is_string($Texto) == true ){

                $textoLimpo = trim($Texto);
                return $textoLimpo;
            };
            
        }catch(Throwable $e){
            return "Aconteceu alguma cagada aqui MOrty: " . $e ->getMessage();

        };   
    };

    /**
     * Essa função mostrar o valor de um resultado se é false ou true com um operador ternário
     * Sintaxe básica do operador ternário: 
     *  ( condição) ? expressão_true : expressão_false; (não esqucer dos :)
     * @param bool $Resultado é um parâmetro booleano que por padrão já possui valor true
     * 
     */

    function funcaoOperadorTernario($Resultado = true ):bool {
        try{
            if(is_bool($Resultado)){
                echo ($Resultado == true) ? 'true' : 'false';
                return $Resultado;
            }else{
                echo "Não é booleano!";
                return false;
            };  
        }catch(Throwable $e){
            echo("Aconteceu algum erro aqui: ". $e->getMessage());
            return true;
        };
    };


    /**
     * Essa função mostra como podemos fazer validação com operador ternário e usar a função nativa number_number_format()
     * @param float $valor é um parâmetro que rescebe um float
     * @return string o retorno é valor, número float passado para a função formatado!
     */


    function formatar_value(float $valor=102390123523.123):string{
        try{
            if(is_float($valor)){   

                // presta atenção que o operador ternário está na nossa função number_format
                $numberFormatado = number_format(($valor ? $valor : 0),2,',','.');

                // função nativa do php que formata números
                // primiero parâmetro é o número, 
                // segunda as casas decimais, 
                // terceiro, caracter usado como separador de casas decimais, 
                // quarto, caracter usado para separados de milhares     
                
                $menssagem = "Aqui está o nosso número formatado: " . $numberFormatado; 
            
                return $menssagem;
            }else{
                return "Não foi possível realizar a formatação deste número, por favor, tente novamente!";
            };
        }catch(THrowable $e){
            return "Aconteceu alguma cagada aqui: ". $e -> getMessage();
        };
    };

    /**
     * Esta função formata apenas números inteiros
     * @param int valor do número inteiro
     * @return string - retorna o número inteiro formatado
     */
    function formartar_number(int $valor = 10):string{
        try{
            if(is_int($valor)){

                $numFormatado = number_format(($valor ? $valor:0),0,".","."); 
                return "Morty! Essa é a nossa função que forma números inteiros: ". $numFormatado;
            }else{
                return "Não foi possível realizar a formatação do número!";  
            };
        }catch(THrowable $e){
            return "Aconteceu alguma cagada aqui: " .$e -> getMessage();
        };
    };

    /**
     * Essa função tem como principal objetivo definir a nossa Data e hora Padrão
     * @param string  $data é uma variável que rescebe uma string de valor padrão da função nativa date
     * @return string  - retorna o fuso horário formatado com data e hora!
    */
    function fusioHorarioPadrão(?string $data = null):string{  // o ? na frente do string, indica que o parâmetro pode ser string | null
        try{
            if($data==null){
                $data = date('d/m/Y H:i:s');
                return  "Esse é o nosos fuso Horário Padrão Morty! " .$data ." Segundo o Fuso HOrário do São Paulo!";
            }else{    
                return $data;
            }
        }catch(Throwable $e){
            return "Aconteceu alguma cagada aqui Morty!  " .$e->getMessage();
        };
    };
    

    /** 
     * Esta função basicamente doi criada para brincar com alguns cálculos de tempo e funções nativas do PHP
     *@param string $data é uma string no formato TIMESTAMP
     *@return string - O retorno é uma string mostrando a quanto tempo algo imaginário foi postado 
    */

    function contarTempo(string $data): string {

        // função nativa do PHP que ajusta o fuciorário local, é interessante instanciar ele no arquivo de configuração !
        date_default_timezone_set('America/Sao_Paulo'); # Lista de fuso Horário Suportados -> https://www.php.net/manual/pt_BR/timezones.america.php (ctrl + click)

        $agora = time(); // time() é uma função nativa que de fato pega o tempo atual em segundos
        $tempo = strtotime($data); // strtotime() é uma função que pega a data e a hora e transforma em segundos
        $diferenca = $agora - $tempo;

        $segundos = $diferenca;
        $minutos = floor($diferenca / 60); # é uma função nativa do PHP que pega o valor “cheio” já completado.
        $horas = floor($diferenca / 3600); # podemos usar a função round() também, porém ela arredonda para cima ou par abaixo depedendo da fração
        $dias = floor($diferenca / 86400);
        $semanas = floor($diferenca / 604800);
        $meses = floor($diferenca / 2592000);
        $anos = floor($diferenca / 31536000);

        if ($segundos <= 60) {
            return 'Foi postado agora';
        } elseif ($minutos <= 60) {
            return $minutos == 1 ? "Foi postado há 1 minuto" : "Foi postado já faz $minutos minutos";
        } elseif ($horas <= 24) {
            return $horas == 1 ? "Foi postado há 1 hora" : "Foi postado já faz $horas horas";
        } elseif ($dias <= 7) {
            return $dias == 1 ? "Foi postado há 1 dia" : "Foi postado já faz $dias dias";
        } elseif ($semanas <= 4) {
            return $semanas == 1 ? "Foi postado há 1 semana" : "Foi postado já faz $semanas semanas";
        } elseif ($meses <= 12) {
            return $meses == 1 ? "Foi postado há 1 mês" : "Foi postado já faz $meses meses";
        } else {
            return $anos == 1 ? "Foi postado há 1 ano" : "Foi postado já faz $anos anos";
        }
        //var_dump($agora,$tempo,$diferenca);
    };

?>