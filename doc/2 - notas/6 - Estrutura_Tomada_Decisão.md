# Introdução

Este arquivo tem como objetivo ensinar todas as estruturas de toma de decisão com a linguagem PHP.



## Estrutura Básica

- Esse é manjado, também conhecido como if, else, elseif:

```php
<?php
    $valor = 10;

    if ($valor > 0) {
        echo "É positivo";
    } elseif ($valor < 0) {
        echo "É negativo";
    } else {
        echo "É zero";
    }
?>
```

- Sintaxe: 

    if(condição){
        intruções;
    }
    elseif(condição){
        instruções;
    }else{
        intruções;
    };

- Detalhes:
    
    elseif pode ser escrito elseif (uma palavra) ou else if (duas palavras). Ambos funcionam.

    O else é opcional.

    Você pode aninhar if dentro de if.


## Operador ternário ? :
Forma compacta do if/else para expressões simples.

```php
<?php

    $idade = 18;

    echo ($idade >= 18) ? "Maior de idade" : "Menor de idade";

?>
```

- Sintaxe: 

    condição ? valor_se_verdadeiro : valor_se_falso

- Detalhes:

    Podemos usar em atribuições de variáveis -> $status = ($idade >= 18) ? "Adulto" : "Menor";
    
    PHP permite aninhar ternários, mas cuidado, pois fica ilegível rápido. 
    -> $nota = 7;
    $conceito = ($nota >= 9) ? "A" : (($nota >= 7) ? "B" : "C");
    echo $conceito; // B

    Ternário encurtado (PHP 5.3+) -> PHP permite omitir a parte valor_true, usando só ?:.

    Exemplo:

    $nome = "";

    echo $nome ?: "Visitante"; // Visitante

    Equivale:

    echo ($nome) ? $nome : "Visitante";

    atalho prático para se variável está vazia → usa outro valor.

- Atenção e Observações, Armadilhas — precedência:

O ternário tem precedência baixa! Se misturar com || ou &&, use parênteses, senão o resultado pode ser estranho.

Exemplo da armadilha:

```php
<?php
    echo true || false ? "SIM" : "NÃO"; 
    // Resultado: SIM

    // Interpretação real:
    echo (true) || (false ? "SIM" : "NÃO");
    // Então o ternário nem é avaliado.
?>
```

Exemplo do modo certo de usar:

```php
<?php

    echo (true || false) ? "SIM" : "NÃO"; 
    // Resultado: SIM
?>
```

Ternário vs Null Coalescing

Não confunda:

    ?: — se o valor for falsy (0, '', null, false, []), usa o fallback.

    ?? — se não estiver definido ou for explicitamente null.

Exemplo:

``` php
<?php

    $var = 0;

    echo $var ?: "fallback"; // fallback (porque 0 é falsy)
    echo $var ?? "fallback"; // 0 (porque existe)

?>
```