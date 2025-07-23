# Introdução

Este documento visa ser um guia para utilizar corretamente a função preg_grep.

## O que é o preg_preg_grep?

preg_grep filtra arrays com regex.

Pense assim:

    Ele varre cada elemento do array e retorna só os que casam com o padrão.

##  Assinatura

```php
<?php
    
    array preg_grep ( 
        string $pattern , 
        array $input [, int $flags = 0 ] );
?>
```

### Parâmetros

| Parâmetro  | Tipo   | Descrição                                               |
| ---------- | ------ | ------------------------------------------------------- |
| `$pattern` | string | Expressão regular para testar cada elemento.            |
| `$input`   | array  | Array de strings a serem filtradas.                     |
| `$flags`   | int    | `PREG_GREP_INVERT` → inverte o filtro (exclui casados). |

Retorno:
    Um array filtrado, mantém as chaves originais.

## Exemplos:

**Filtrar palavras que começam com maiúscula:**
```php
<?php

    $input = ["PHP", "java", "Python", "golang", "C++"];
    $result = preg_grep("/^[A-Z]/", $input);

    print_r($result);
    // Array
    // (
    //     [0] => PHP
    //     [2] => Python
    //     [4] => C++
    // )

?>
```

Explicação:

- /^[A-Z]/ → Começa com letra maiúscula.

- "PHP", "Python" e "C++" passam.

- "java" e "golang" não.

**Filtrar emails válidos por padrão simples:**

```php
<?php

    $emails = [
        "usuario@dominio.com",
        "invalido",
        "admin@site.org",
        "teste"
    ];

    $result = preg_grep("/@/", $emails);

    print_r($result);
    // Array
    // (
    //     [0] => usuario@dominio.com
    //     [2] => admin@site.org
    // )

?>
```

Explicação:

- /@/ → Verifica se contém @.

- Apenas elementos com @ passam.

**Invertendo o filtro:**

```php
<?php
    $nomes = ["Ana", "Bruno", "Carlos", "ana", "carlos"];
    $result = preg_grep("/^A/", $nomes, PREG_GREP_INVERT);

    print_r($result);
    // Array
    // (
    //     [1] => Bruno
    //     [2] => Carlos
    //     [3] => ana
    //     [4] => carlos
    // )
?>
```

Explicação:

- /^A/ → Começa com A.

- PREG_GREP_INVERT → Exclui os que casam (Ana).

- Mantém o resto.

**Usar com arrays associativos:**

```php
<?php
    $dados = [
        "nome1" => "João",
        "nome2" => "maria",
        "nome3" => "Pedro",
        "nome4" => "ana"
    ];

    $result = preg_grep("/^[A-Z]/", $dados);

    print_r($result);
    // Array
    // (
    //     [nome1] => João
    //     [nome3] => Pedro
    // )
?>
```

Explicação:

- Funciona com chaves associativas — as chaves são mantidas.

**Casos avançados: ignorar maiúsculas/minúsculas:**
Modificador para case-insensitive: use i.

```php
<?php
    $input = ["João", "maria", "Pedro", "ana"];
    $result = preg_grep("/^a/i", $input);

    print_r($result);
    // Array
    // (
    //     [1] => maria
    //     [3] => ana
    // )
?>
```

Explicação:

- /^a/i → Começa com a ou A.

## Diferença para array_filter

| Função           | O que faz                            | Potência                      |
| ---------------- | ------------------------------------ | ----------------------------- |
| `array_filter()` | Filtra usando uma **função anônima** | Flexível para qualquer lógica |
| `preg_grep()`    | Filtra usando **regex direto**       | Mais curto quando é só regex  |

## Casos de uso comuns

✅ Filtrar linhas de um log que contêm erro.
✅ Selecionar nomes com padrão específico.
✅ Remover strings que casam (invert).
✅ Filtrar arrays de emails, domínios, extensões.

## Limitação

preg_grep não transforma valores → só filtra.

Para modificar elementos, use preg_replace + array_map.

## Combinação prática

Filtra e depois substitui:

```php
<?php
    $nomes = ["Ana", "Bruno", "Carlos", "ana", "carlos"];
    $filtrados = preg_grep("/^A/i", $nomes);

    $maiusculos = array_map('strtoupper', $filtrados);

    print_r($maiusculos);
    // Array
    // (
    //     [0] => ANA
    //     [3] => ANA
    // )
?>
```

## Resumo rápido
| Situação         | Padrão                      | Efeito                                    |
| ---------------- | --------------------------- | ----------------------------------------- |
| Filtrar          | `/^A/`                      | Só strings que começam com A              |
| Inverter         | `/^A/` + `PREG_GREP_INVERT` | Tudo **exceto** strings que começam com A |
| Case insensitive | `/^a/i`                     | Ignora maiúscula/minúscula                |
| Mantém chave     | —                           | Mantém índices originais                  |

## Teste na prática

Combina preg_grep, preg_replace e preg_match para validar listas de forma poderosa, limpa e sem loops manuais.