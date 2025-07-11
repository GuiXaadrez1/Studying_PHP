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
        }

        // Para ver a saudação, você precisa chamar a função e exibir seu retorno:
        // echo saudacao();
?>