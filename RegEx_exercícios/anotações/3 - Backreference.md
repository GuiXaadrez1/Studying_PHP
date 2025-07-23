# Introdução
Neste documento vamos aprender sobre o Backreference (referência a gtupos anteriores)

Em regex, quando você envolve algo com parênteses (), isso vira um grupo de captura.

Cada grupo é numerado na ordem em que aparece: (1), (2), (3), etc.

Você pode referenciar o que foi capturado dentro da própria regex, usando \1, \2…

Isso é chamado de backreference → “referência reversa”.

**observações:** essa documentação vai servir de guia para os seguintes exercícios nos scripts.php:

- Backreference1.php

## Para que serve? 

Para garantir que partes da string sejam iguais.

Objetivo clássico:

Encontrar palavras duplicadas como the the ou cat cat.

## Exemplo de Backreference

```regex
    /\b(\w+)\s\1\b/
```

Vamos destrinchar isso:

- \b

Limite de palavra (word boundary).
Garante que você começa no início de uma palavra.

- 2️⃣ (\w+)
Grupo de captura 1.

\w+ → Uma ou mais letras/dígitos/underscores.

Exemplo: pega the.

- \s

Um espaço.
Precisa haver um espaço entre os dois iguais.

- \1

Aqui está o backreference.
Significa: a mesmíssima sequência que o grupo 1 capturou.

Então, se (\w+) pegou the, \1 exige que a mesma palavra apareça logo depois.

- \b

Limite de palavra de novo.
Garante que termina no fim da segunda palavra.

## O que isso faz?

Traduzindo em linguagem humana:

    “Encontre uma palavra, depois um espaço, depois a mesma palavra de novo.”

Casa: the the (ocorrência)
Casa: cat cat (ocorrência)
Não casa: cat dog  (ocorrência)

## Demonstração em PHP

```php
<?php

    $texto = "the the cat cat dog dog cat dog";
    $pattern = '/\b(\w+)\s\1\b/';

    preg_match_all($pattern, $texto, $matches);

    print_r($matches[0]);
    // Saída: Array ( [0] => the the [1] => cat cat [2] => dog dog )

?>
```

## Dica: Referências Numeradas

| Notação | O que faz          |
| ------- | ------------------ |
| `(abc)` | Grupo de captura 1 |
| `(def)` | Grupo de captura 2 |
| `\1`    | Igual ao grupo 1   |
| `\2`    | Igual ao grupo 2   |

## Diferença: Backreference x Lookaround

Backreference: Consome → substitui por igual.

Lookahead/Lookbehind: Só testa, não consome.

## Aplicações comuns de backreference

Encontrar palavras duplicadas.

Validar pares simétricos (<tag>conteúdo</tag>).

Expressões complexas com mesmo texto repetido em locais diferentes.

## Resumo técnico

| Regex           | Descrição                                      |
| --------------- | ---------------------------------------------- |
| `(\w+)`         | Grupo 1: palavra                               |
| `\1`            | Repete **exatamente** o que o Grupo 1 capturou |
| `\b(\w+)\s\1\b` | Palavra + espaço + mesma palavra               |

**observação:**  Lembrando que se usar a classe de caracteres \B -> Não tem limite de palavra
