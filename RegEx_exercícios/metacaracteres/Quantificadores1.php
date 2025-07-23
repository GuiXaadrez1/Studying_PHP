<?php
    // ativando tipagem explícita

    declare(strict_types = 1);

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // O obejtivo deste arquivo.php é entender o que seria os metacaracter de repetição
    // também chamados de quantificadores! 
    // {} -> Chaves são os nossos quantificadores
    // eles determinam a quantificação dos nossos metacaracteres genéricos (literais)!
    // exemplo: /^[A-Z][a-z]{5}\.$/ -> _ _ _ _ _ _ . -> Brasil. 

    // exemplo2: /^[A-Z][a-z]{3,7}\.$/

    //{n,espaço_vazio} -> (mínimo, sem_valor_máximo_pode_ser_qualquer_qauntidade) -> /\d{2,}/
    // {n,m} -> (mínimo,máximo) -> Quando você ver esse quantificador com uma determinada quantidade, depois uma vírgula 
    // outra determiando quantidade, estamos falando o seguinte -> Repita o padrão anterior pelo menos 3 vezes e no máximo 7 vezes.

    /*
        exemplos de casos válidos e inválidos


        bc ✅ (3 letras)

        abcdefg ✅ (7 letras)

        abcd ✅ (4 letras)

        ab ❌ (só 2 letras, mínimo é 3)
    
    */

    // TRADUÇÃO -> A string deve começar com uma letra maiúscula, seguida de exatamente cinco letras minúsculas, terminando com um ponto final
    
    /*
        TABELA DOS SIMBOLOS: 

        | Padrão     | Significado                                                         |
        | ---------- | ------------------------------------------------------------------- |
        | `/.../`    | Delimita a expressão regular (sintaxe de regex)                     |
        | `^`        | Âncora de início da string                                          |
        | `[A-Z]`    | Um **único caractere maiúsculo** (de A a Z)                         |
        | `[a-z]{5}` | Exatamente **cinco letras minúsculas** (de a a z)                   |
        | `\.`       | Um **ponto literal** (o `\` escapa o `.` para que não seja coringa) |
        | `$`        | Âncora de fim da string                                             |
    
        Observaçãoo o meta caracter \w -> representa todos os caracteres word [A-Za-z0-9_]
    */

    // Exercícios!  

    /* 
        Crie uma função que pegue um array [unidimensional homogêneo] de números com tipo de dados string de n conjuntos de caracteres, filtre e retorne uma lista [array unidimensional]
        contento apenas números com 3 dígitos!
    */

    $numeros = [
        '7',      
        '23',     
        '145',  
        '6789',  
        '12345',  
        '89',     
        '432',    
        '87654',  
        '999'     
    ];

    function filtrar_num(array $array_num):array{
        try{
            $validacao_array = is_array($array_num)?true:false; 
        
            if($validacao_array == true){
                
                // definindo nosso array homogêneo de inteiros unidimensional para nossa lista 
                    $listaNum = [];                
                
                // usando for tradicional 
                
                for ($i = 0; $i < count($array_num); $i++){
                    
                    $regex = "/^\d{3}$/"; // é o mesmo que $pattern da função preg_mach_all()

                    preg_match_all($regex,$array_num[$i],$matches);
                    
                    # Sempre fazer essa verificação de vazios ou nulos
                    # porque para alguns elementos do array, o regex não encontrou nenhum match, 
                    # logo $matches[0] é vazio → tentar acessar [0][0] gera acesso a índice inexistente.
                    
                    if(isset($matches[0][0]) && !empty($matches[0][0])){
                        $listaNum[] = (string) ($matches[0][0]);
                    }else{
                        $listaNum[] = "0"; // ou null, ou false, ou uma string tipo "Sem Match"
                    }

                };

                return array_filter($listaNum, function($num){return $num !== '0'; });

            }else{
                return (array) ("Não foi possível realizar a filtragem dos números. ");
            };
        
        }catch(Throwable $e){

            # Lembre-se de colocar () em lógica para definir prioridade de leitura de código.

            return (array) ("Error: " . $e->getMessage());

            # “Transforme essa string em um array de um único elemento, na posição zero.”

            /*
                OSERVAÇÕES SOBRE Throwable $e

                Throwable é o tipo (classe base ou interface).

                $e é a variável que aponta para a instância concreta que foi lançada (ex: Exception, Error, TypeError, DivisionByZeroError).

                Você não está materializando a classe Throwable diretamente (porque Throwable não é instanciada sozinha), mas o PHP faz o bind polimórfico:

                Qualquer objeto que herde ou implemente Throwable cabe ali.

                Então:

                    ✅ Sim, $e é um objeto, que representa uma instância concreta de alguma subclasse de Throwable
            
            */

        }
    }

    echo "Nossa Lista de números com 3 dígitos: " . "<br>";
    echo (implode(", ",filtrar_num($numeros)));

    /* 
        Crie uma função que pegue todas as palavras que possuem no mínimo 5 caracteres e no máximo 7 de uma palavra.
        e retorne cada palava com essa quantidade de caracteres em uma lista.
    */

    $palavra = "Eu nasci forte, poderoso, amoroso e gostoso!";

    echo "<hr>";

    function filtrar_texto(string $texto):array{
        try{
            if(is_string($texto)){
                
                $regex = "/\w{5,7}/";

                preg_match_all($regex,$texto,$matches);

                return $matches[0];
            }else{
                return (array) ("Não foi possível realizar a filtragem do texto. ");
            };
        }catch(Throwable $e){
            return  (array) ("Error: " . $e->getMessage());
        };
    };

    echo "Abaixo está a nossa lista de palavras com no mínimo 5 caracteres e no máximo 7: " . "<br>";

   echo (implode(", ",filtrar_texto($palavra)));

?>