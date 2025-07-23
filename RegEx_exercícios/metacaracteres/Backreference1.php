<?php
    // ativando tipagem explícita!
    declare(strict_types=1);
    
    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações

    // Vamos entender um pouco sobre Backreference

    // basicamente ele serve para referenciar um grupo de captura anterior a ele

    // Exemplo de um regex backreference 
    
    //  /\b(\w+)\s\1\b/ 

    // Lembrando que se usar: \B -> Não tem limite de palavra
    

    // Exercício 
    // Faça uma função que resceba um texto que possui números de telefone
    // retorne todas as ocorrências que este número foi duplicado no texto
    // isto é: (61) 991456334 ... (61) 991456334
    // é permitido DDD diferentes

    function search_phone(string $text):string{
        try{
            if(is_string($text)==true){
                $regex = '/\(\d{2}\)\s.*?\d{5}-\d{4}/';
                preg_match_all($regex,$text,$matches);

                #print_r($matches[0]);

                    // Conta quantas vezes cada valor aparece:
                    $contagem = array_count_values($matches[0]);

                if(!empty($matches[0])){
                
                    // Conta quantas vezes cada valor aparece:
                    $contagem = array_count_values($matches[0]);

                    /* a função acima cria um array

                        ✅ Recebe um array como entrada.
                        ✅ Conta quantas vezes cada valor aparece nesse array.
                        ✅ Retorna um novo array associativo, onde:

                            Chave = valor original.

                            Valor = quantidade de vezes que ele apareceu.                    
                    */
                
                    $resultados = "";

                    foreach ($contagem as $valor => $qtd){
                        if ($qtd > 1) {
                            $resultados .= "$valor aparece $qtd vezes. <br>";

                            /*  Explicação sobre: .=    

                                O . (ponto) é o operador de concatenação no PHP.

                                O = é o operador de atribuição.

                                Juntos . + = formam .=, que faz:

                                Pega o valor atual da variável.

                                Junta o novo conteúdo.

                                Salva o resultado de volta na mesma variável.
                                                    
                            */
                        };
                    };

                    return $resultados ?: "Nenhum valor repetido!";
                
                }else{
                    return "Os valores dentro do array são nulos!";
                };
            }else{
                return "Não foi possível realizar a busca dos telefones duplicados.";
            };
        }catch(Throwable $e){
            return "Error: " . $e->getMessage();
        }
    };

    $texto = "
        Aqui estão alguns números de telefone:
        (61) 99145-6334 e depois novamente (61) 99145-6334 na mesma frase.
        Outro exemplo: (11) 98765-4321 aparece duas vezes: (11) 98765-4321.
        Já este aqui é diferente: (21) 91234-5678 e (21) 91234-5678.
        Tem também um DDD diferente mas mesmo número: (31) 99111-2222 e (61) 99111-2222.
        Por fim, (98) 99999-0000 aparece só uma vez para teste.
    ";

    echo search_phone($texto);
?>