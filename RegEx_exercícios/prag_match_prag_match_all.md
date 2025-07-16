# Introdução 
Este documento visa mostrar e ensinar como funciona as funções nativas para a contrução
do nosso querido Regex com PHP, bem como os parâmetros de cada e exemplos!



## Função preg_match()

### Estrutura:

```php
<?php

    preg_match(
      string $pattern,   // O padrão regex
    string $subject,   // O texto de entrada onde buscar
    array &$matches = null, // Variável onde o PHP vai colocar os matches encontrados
    int $flags = 0,    // Flags opcionais de controle
    int $offset = 0    // Posição de início dentro do texto
    ): int|false
?>
```

### Parâmetros Explicados

| Parâmetro      | Significado                                                                                                                      |
| -------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| **`$pattern`** | **A expressão regular**. Sempre começa e termina com delimitador `/pattern/` (ou `#pattern#`, etc).                              |
| **`$subject`** | **A string alvo** onde o PHP vai procurar.                                                                                       |
| **`$matches`** | **Array de saída**. Recebe os matches. Passado **por referência** (`&$matches`).                                                 |
| **`$flags`**   | Controla **como o array `$matches` é estruturado** (`preg_match_all`), ou ajusta comportamento (`PREG_OFFSET_CAPTURE` em ambos). |
| **`$offset`**  | Posição inicial na `$subject`. Você pode fazer matching só a partir de certo ponto.                                              |

### Flags úteis

preg_match() só tem o PREG_OFFSET_CAPTURE:

Adiciona a posição de cada match.

Exemplo:

```php
<?php
    preg_match('/\d+/', 'ABC 123 DEF', $matches, PREG_OFFSET_CAPTURE);
    // $matches[0] = ['123', 4]  ← valor + posição
?>
```

### O que a função retorna?

| Função                 | Retorno                                                                                      |
| ---------------------- | -------------------------------------------------------------------------------------------- |
| **`preg_match()`**     | **0** → não encontrou nada. **1** → encontrou pelo menos uma vez. **false** → erro de regex. |


## Função preg_match_all()

### Estrutura:

```php
<?php
    preg_match_all(
    string $pattern,
    string $subject,
    array &$matches = null,
    int $flags = PREG_PATTERN_ORDER, // Difere do preg_match()!
    int $offset = 0
    ): int|false
?>
```

###  Parâmetros explicados

| Parâmetro      | Significado                                                                                                                      |
| -------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| **`$pattern`** | **A expressão regular**. Sempre começa e termina com delimitador `/pattern/` (ou `#pattern#`, etc).                              |
| **`$subject`** | **A string alvo** onde o PHP vai procurar.                                                                                       |
| **`$matches`** | **Array de saída**. Recebe os matches. Passado **por referência** (`&$matches`).                                                 |
| **`$flags`**   | Controla **como o array `$matches` é estruturado** (`preg_match_all`), ou ajusta comportamento (`PREG_OFFSET_CAPTURE` em ambos). |
| **`$offset`**  | Posição inicial na `$subject`. Você pode fazer matching só a partir de certo ponto.                                              |

## Flags úteis
preg_match_all() tem flags muito importantes:

PREG_PATTERN_ORDER (padrão): Organiza por grupos:

```php
<?php
    
    [ 
        0 => [ 'caso1', 'caso2' ], 
        1 => [ 'grupo1 do caso1', 'grupo1 do caso2' ]
    ]
?>
```

PREG_SET_ORDER: Organiza por ocorrências:

```php
<?php
    [
        [0 => 'caso1', 1 => 'grupo1 do caso1'],
        [0 => 'caso2', 1 => 'grupo1 do caso2']
    ]
?>
```

PREG_OFFSET_CAPTURE: Mesmo efeito, adiciona posições.

### O que a função retorna?

| Função                 | Retorno                                                                                      |
| ---------------------- | -------------------------------------------------------------------------------------------- |
| **`preg_match_all()`** | Número de vezes que bateu (`n`). **false** em caso de erro.                                  |


## Exemplo

```php
<?php

    $string = "Hoje é dia 16, amanhã é 17.";

    preg_match_all(
    '/\d+/',
    $string,
    $matches,
    PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE
    );

    print_r($matches);

    /* Saida: 
        [
            [ 
                [ '16', 10 ], // valor, posição
                [ '17', 23 ]
            ]
        ]
    
        - Veja que retornou um array multidimensional
    */
?>
```

## Diferença resumida

|                           | **preg\_match()**              | **preg\_match\_all()**      |
| ------------------------- | ------------------------------ | --------------------------- |
| **Encontra o quê?**       | Apenas **primeira ocorrência** | **Todas as ocorrências**    |
| **Retorno?**              | `1` ou `0`                     | `n` (número de matches)     |
| **Estrutura `$matches`?** | Uma única captura              | Arrays aninhados por padrão |


## Resumo de Uso

- preg_match() — use para um match só, simples, validar formato.
- preg_match_all() — use para varrer tudo (ex.: emails, datas, números).
- $matches — sempre passa por referência, recebe valor e grupos.
- Flags — domine PREG_OFFSET_CAPTURE e PREG_SET_ORDER para transformar o formato.


## OBSERVAÇÃO IMPORTANTE! Contexto: Como funciona o $matches em preg_match_all

    Quando você usa preg_match_all($pattern, $subject, $matches), o PHP preenche a variável $matches com um array multidimensional
    que contém os resultados da busca da expressão regular.

Estrutura básica do $matches:
    
    $matches[0] → contém todos os textos que casaram com o padrão inteiro (a regex completa).

    $matches[1] → contém todos os textos que casaram com o primeiro grupo de captura (o primeiro conjunto de parênteses () da regex).

    $matches[2] → contém todos os textos que casaram com o segundo grupo de captura, e assim por diante...

O que significa o índice interno [0]

    Cada um desses arrays pode conter múltiplas ocorrências (casos onde a regex bateu várias vezes no texto).

    $matches[0][0] → a primeira ocorrência do texto que casou com o padrão completo.

    $matches[0][1] → a segunda ocorrência do texto completo.

    $matches[1][0] → a primeira ocorrência do texto que casou com o primeiro grupo de captura.

    $matches[1][1] → a segunda ocorrência do texto que casou com o primeiro grupo de captura.

## Resumo da Observação:

| Índice           | O que representa                                                       | Exemplo           |
| ---------------- | ---------------------------------------------------------------------- | ----------------- |
| `$matches[0][0]` | Primeira ocorrência do texto que casou com a regex completa            | `(51) 97654-3210` |
| `$matches[1][0]` | Primeira ocorrência do texto que casou com o primeiro grupo de captura | `51`              |
| `$matches[0][1]` | Segunda ocorrência do texto que casou com a regex completa             | `(91) 99999-9990` |
| `$matches[1][1]` | Segunda ocorrência do texto que casou com o primeiro grupo de captura  | `91`              |
