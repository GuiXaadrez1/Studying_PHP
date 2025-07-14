# Introdução
Esse arquivo.md tem como objetivo ensinar como criar funções com php, exibir os dados retornados destas funções e etc...
bem como explicar breviamente conceitos como: declaração de variável, concatenação de strings e tratamento de erros.


## Sintaxe de uma função em php


    function <nome_da_função>(aqui_dentro_fica_parâmetros){

        try{
            $nome = "Seu nome!";

            comprimento = "Boa Tarde. ". $nome;

            return cumprimento
        }
        catch(Throwable $e){
            echo "Ocorreu um erro: " . $e->getMessage();
            // Em um ambiente real, você provavelmente logaria esse erro também:
            error_log("Erro na função saudacao: " . $e->getMessage());
        }
    }

### Exmplicação de como criar uma função: 

- Primeiro você declara uma função com a plavra-chave: function
- Segundo da nome para a função: function nome_função
- Terceiro declara ou não parâmetros para essa função: funtion nome_função() -> aqui essa função está sem parâmetros
- Quarto abre e fecha chaves: function nome_função(){} -> aqui essa função está vazia


### Explicação da função acima:
Basicamente declaramos uma função com o nome saudacao sem parâmetros declarados que possui um tratamento de erro try{}catch(Throwable $e){...}
dentro de try{} que é o caminho feliz da nossa aplicação, ou seja, se não deu erro as intruções serão executadas, temos duas variáveis 

que em php declaramos com sifrão $ + o nome da variável, logo fica assim -> $nome_variável e o dinal de igualdade é o nosso operador de
atribuição, ou seja, estamos atribuindo um valor a esta variável, seja: String, Integer, Boolean, Decimal, Float e etc...
ou seja, fica assim -> $nome_variável = "Essa String aqui.", essas duas variáveis rescebem um valor do tipo de dados string
a primeira refere-se ao nome e a segunda refere-se á uma saudação com o nome.
    
diferente de outras linguagens que concatenam strings com + , no php é feita pelo .
ou seja, montamos uma frase em uma variável que concatena com o valor de um aoutra variável, ficando assim:
$cumprimento = "Olá" . $nome e retornamos o valor da variável $cumprimento na nossa função que só pode ser
exibida com um echo();

No caminho triste! ou seja, no catch(Throwable $e){instruções}, temos o seguinte:

- Throwable: 
    
    Em PHP, Throwable é uma interface que serve como a base para todas as classes de exceção e erro que podem ser capturadas. Antes do PHP 7, você só podia usar Exception aqui. Com o PHP 7 e versões posteriores, Throwable foi introduzido para incluir também os "erros" (como TypeError ou DivisionByZeroError) que antes eram considerados fatais e não podiam ser capturados. Ou seja, Throwable é a forma mais abrangente de capturar qualquer tipo de problema que pode acontecer no seu código.

- $e: 
    
    Esta é uma variável. Quando uma exceção ou erro ocorre e é capturado, o PHP cria um objeto que contém todas as informações sobre o problema (qual foi o erro, onde ele aconteceu, etc.). Este objeto é então atribuído à variável $e (você poderia chamar de $erro, $exception, ou o que quisesse, mas $e é uma convenção comum). É através deste objeto $e que você acessa os detalhes do erro

- echo: 
    
    Este é um comando PHP que serve para imprimir (mostrar) algo na tela (no navegador, se for um script web, ou no console, se for de linha de comando).

- "Ocorreu um erro: ": 
    
    Esta é uma string de texto fixa que será exibida para o usuário. É uma mensagem amigável que indica que algo inesperado aconteceu.

- . :
    Em PHP, o ponto é o operador de concatenação. Ele serve para juntar strings. Neste caso, ele une a string fixa "Ocorreu um erro: " com a mensagem de erro que vem do objeto $e.

- $e->getMessage(): Esta é uma chamada de método no objeto $e.

    $e: O objeto que representa a exceção capturada.

    ->: O "operador de objeto" que usamos para acessar propriedades ou métodos de um objeto.

    getMessage(): Este é um método disponível em todos os objetos Throwable (e, portanto, em todas as exceções e erros). Ele retorna uma string contendo a mensagem principal que descreve o erro que ocorreu. Por exemplo, se você tentou dividir por zero, $e->getMessage() retornaria algo como "Division by zero".

- ;: 
    O ponto e vírgula marca o fim da instrução


## COlocando parâmetros na função

Exemplo de função com parâmetros: 

    function calc_velocidade_luz($c,$n,$contexto='ar'){
            try{
                //$velocidade_luz_no_meio = $v;
                $velocidade_luz_vacuo = $c;
                $indicie_refracao_meio = $n;

                $velocidade_luz_no_meio = ($velocidade_luz_vacuo/$indicie_refracao_meio);   

                $resultado = $velocidade_luz_no_meio;

                return "<strong><p>O resultado da velocidade da luz no meio de acordo com o contexto '" . $contexto . "', Morty, é: " . $resultado. "</p></strong>";

            }catch(Throwable $e){
                
                echo "Ocorreu um erro: " . $e->getMessage();
                error_log("Erro na função saudacao: " . $e->getMessage());
            }
        }

Observação: Quando você coloca o parâmtro na função, esses parâmtros obrigatóriamente devem ser colocados para não dar erro