<?php
    // declarando tipagem explícita pra evitar bugs silenciosos
    declare(strict_types=1);

   // faça uma função que valide um cpf com Regex 

    $string_cpf = '324.567.789-33';
    
    //var_dump($string_cpf);

    function validar_cpf(string $cpf):string{
        try{
            $validacao_inicial = is_string($cpf)?true:false;
            if($validacao_inicial == true){

                $subject = $cpf; # string que contém o texto de entrada para ser validado pelo regex
                $pattern = '/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'; # string que contém o nosso Regex

                $validacao_regex = preg_match($pattern,$subject)? true:false;

                if($validacao_regex == true){
                    return "O cpf é válido";
                }else{
                    return "O cpf não é válido!";
                };
            }else{
                return "Não foi possível validar o cpf. ";
            }
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        };
    }; 
    
    echo validar_cpf($string_cpf) . "<hr>";

    // Faça uma função que valide um array de cpfs com expressões regurales

    $array_cpg = [
        "573.635.552-30",

        "184.605.770-15",

        "905.697.874-83",

        "350.178.472-43",

        "740.316.702-30"
    ];



    // função mais complexa, validando um array de cpfs
    function validador_cpg(array $array_cpf):string{
        try{
            $validacao_inicial = is_array($array_cpf)?true:false;

            if($validacao_inicial == true){
                return "Por enquanto, nada!";
            }else{
                return "não foi possível validar todos os cpfs";
            };

        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        }
    }


?>