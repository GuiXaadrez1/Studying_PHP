<?php
    function saudacao(){
        try{
            $nome = "Otário!";
            // Use o ponto (.) para concatenar strings em PHP
            $cumprimento = "Boa tarde, " . $nome;

            return $cumprimento;
        }
        // É uma boa prática não ter um ponto e vírgula depois do bloco catch
        catch(Throwable $e){
            echo "Ocorreu um erro: " . $e->getMessage();
            // Em um ambiente real, você provavelmente logaria esse erro também:
            error_log("Erro na função saudacao: " . $e->getMessage());
        }
    };

    // Para ver a saudação, você precisa chamar a função e exibir seu retorno:
    // echo saudacao();
    
    // criando uma função com parâmetros/variável/argumentos

    function calc_velocidade_luz($c,$n,$contexto='ar'){
        try{
            //$velocidade_luz_no_meio = $v;
            $velocidade_luz_vacuo = $c;
            $indicie_refracao_meio = $n;

            $velocidade_luz_no_meio = ($velocidade_luz_vacuo/$indicie_refracao_meio);   

            $resultado = $velocidade_luz_no_meio;

            return "<strong><p>O resultado da velocidade da luz no meio no contexto do '" . $contexto . "', Morty, é: " . $resultado. "</p></strong>";

        }catch(Throwable $e){
            
            echo "Ocorreu um erro: " . $e->getMessage();
            error_log("Erro na função saudacao: " . $e->getMessage());
        }
    }
?>