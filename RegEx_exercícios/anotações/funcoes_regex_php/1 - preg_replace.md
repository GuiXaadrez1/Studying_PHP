# Introdução
Este documento visa ser um guia para utilizar corretamente a função preg_replace.

## O que é o preg_replace?
preg_replace é uma função nativa do PHP que executa busca e substituição em strings usando expressões regulares Perl-Compatible (PCRE).

## Assinatura

```php
<?php
    mixed preg_replace ( 
        mixed $pattern , 
        mixed $replacement , 
        mixed $subject [, int $limit = -1 [, int &$count ]] 
    );
?>
```

### Parâmetros:

| Parâmetro      | Tipo             | Descrição                                                                               |
| -------------- | ---------------- | --------------------------------------------------------------------------------------- |
| `$pattern`     | string ou array  | A(s) expressão(ões) regular(is) que define(m) o(s) padrão(ões) a ser(em) encontrado(s). |
| `$replacement` | string ou array  | O(s) valor(es) que substituirá(ão) o(s) padrão(ões).                                    |
| `$subject`     | string ou array  | A(s) string(s) na(s) qual(is) a busca/substituição ocorrerá.                            |
| `$limit`       | int              | Quantidade máxima de substituições por padrão por string (padrão: ilimitado).           |
| `$count`       | int (referência) | Se fornecido, recebe o número de substituições realizadas.                              |

### Retorno

Uma string ou array de strings com os padrões substituídos.
Retorna NULL se ocorrer erro.

### Conceito básico

Pense como:

    “Busque este padrão na string, troque-o por isso, quantas vezes eu quiser.”

## Exemplos: 

**Substituir dígitos por X:**

```php
<?php
    $subject = "Meu número é 12345 e meu código é 678.";
    $result = preg_replace("/\d+/", "X", $subject);
    echo $result; // Saída: Meu número é X e meu código é X.
?>
```
Passo a passo:

- /\d+/ → Expressão que encontra um ou mais dígitos (\d é [0-9], + é quantificador “um ou mais”).

- "X" → Valor que substituirá cada ocorrência.

- "Meu número é 12345 e meu código é 678." → String original.

- Resultado → Cada bloco de dígitos vira "X".

**Substituir palavras específicas:**

```php
<?php
    $subject = "Eu gosto de PHP, Java e Python.";
    $result = preg_replace("/Java|Python/", "C++", $subject);
    echo $result; // Saída: Eu gosto de PHP, C++ e C++.
?>
```

Passo a passo:

    /Java|Python/ → Expressão com alternância (|) → casa Java ou Python.

    "C++" → Substituto.

    "Eu gosto de PHP, Java e Python." → Texto original.

    Saída → Cada ocorrência vira "C++".

**Usando grupos e backreferences:**

```php
<?php
    $subject = "2025-07-23";
    $result = preg_replace("/(\b\d{4})-(\d{2})-(\d{2})\b/", "$3/$2/$1", $subject);
    echo $result; // Saída: 23/07/2025
?>
```

Passo a passo:

/(\d{4})-(\d{2})-(\d{2})/ → Padrão para datas YYYY-MM-DD:

- (\d{4}) → grupo 1 → ano.

- (\d{2}) → grupo 2 → mês.

- (\d{2}) → grupo 3 → dia.

"$3/$2/$1" → Substituto:

- $3 = dia.

- $2 = mês.

- $1 = ano.

Assim reordena a data para formato brasileiro: DD/MM/YYYY.

**Substituindo várias palavras com arrays:**

```php
<?php
    $subject = "Olá mundo cruel!";
    $patterns = ["/mundo/", "/cruel/"];
    $replacements = ["universo", "maravilhoso"];

    $result = preg_replace($patterns, $replacements, $subject);
    echo $result; // Saída: Olá universo maravilhoso!
?>
```

$patterns → array de padrões.

$replacements → array de substituições.

Regra: cada índice substitui o padrão correspondente.

**Usando $limit e $count:**

```php
<?php
    $subject = "um dois três dois quatro dois";
    $pattern = "/dois/";
    $replacement = "X";

    $count = 0;
    $result = preg_replace($pattern, $replacement, $subject, 2, $count);

    echo $result; // Saída: um X três X quatro dois
    echo $count;  // Saída: 2
?>
```

Explicação:

    2 → limite de 2 substituições.

    $count → variável passada por referência → armazena quantas substituições foram feitas de fato.

**Substituir HTML perigoso:**

```php
<?php
    $html = "<p>Olá <b>mundo</b>!</p>";
    $clean = preg_replace("/<.*?>/", "", $html);
    echo $clean; // Saída: Olá mundo!
?>
```

/ <.*?> / → Expressão para encontrar qualquer tag HTML (< seguido de qualquer coisa até >).

Substituição por "" → remove as tags.

Resultado → só o texto.

## ⚠️ Cuidados importantes

Greedy vs Lazy: .* é ganancioso → .*? é não ganancioso.

Exemplo resultado errado: 

```php
<?php
    preg_replace("/<.*>/", "", "<p>Oi</p><b>!</b>");
    // Resultado errado: !
?>
```

Exemplo resultado certo:

```php
<?php
    preg_replace("/<.*?>/", "", "<p>Oi</p><b>!</b>");
    // Correto: Oi!
?>
```

Escape: Para substituir algo literal que pode ser interpretado como regex (ex: .), use \..
Erros: Se o padrão for inválido, retorna NULL e gera um warning.

## Resumo prático

| Situação         | Padrão     | Substituição | Resultado               |
| ---------------- | ---------- | ------------ | ----------------------- |
| Remover números  | `/\d+/`    | `""`         | Remove todos os dígitos |
| Trocar palavras  | `/dog/`    | `"cat"`      | Troca "dog" por "cat"   |
| Reordenar grupos | `/(A)(B)/` | `"$2$1"`     | Inverte AB para BA      |

## Dica de ouro

Combine preg_replace com grupos () e backreferences $1, $2, $3 para manipular partes específicas da string.

Dominar isso economiza linhas de código e faz limpeza de texto complexa ser simples.

## Teste ao vivo

Use  regex101.com - https://regex101.com/ 

ou

php sandbox  - https://www.php.net/manual/en/function.preg-replace.php

para experimentar expressões.

Sempre valide: regex são potentes, mas erros são silenciosos.