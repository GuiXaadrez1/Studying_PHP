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

## Específicação sobre a classe de caracter \b:

### O que é o \b?

- O \b em regex significa "limite de palavra" (word boundary).

- É um ponto no texto onde a transição acontece entre:

- Um caractere de palavra (word character, que o regex entende como \w)
e
- Um caractere que NÃO é palavra (não-word character, \W), ou o começo/fim da string.

Siginifica:

    Um ponto onde um caractere de palavra (\w = [A-Za-z0-9_]) encosta em um caractere que não é palavra (\W).

### O que é um caractere de palavra (\w)?

No padrão PCRE usado no PHP, \w equivale a:

- Letras maiúsculas e minúsculas A-Z, a-z

- Dígitos 0-9

- O underline _

ou seja: 

```regex
    \w == [A-Za-z0-9_]
```

### Como funciona o \b na prática?

\b não casa nenhum caractere em si, ele casa uma posição entre caracteres.

Essa posição precisa ser entre:

- Um caractere de palavra (\w)

- E um caractere que não é palavra (\W)

- Ou início/fim da string.

### Exemplos práticos

Considere o texto:
```bash
    "foo bar"
```

Explicação:

\bfoo\b casa "foo" porque:

- Antes do f tem o início da string (limite entre nada e f, que é \w)

- Depois do o tem um espaço (não \w)

- \bbar\b casa "bar" pelo mesmo motivo.

### Onde o \b NÃO casa?

Dentro de uma palavra:

"foobar" —

Aqui, \bfoo\b não casa, porque depois do o tem b, que é \w — então não é limite.

Posição entre dois caracteres de palavra não é limite.

### O que não é \b?

Não é um caractere, não consome nada da string.

Não é um espaço, não é um símbolo.

É apenas uma posição entre caracteres.

### E quanto a caracteres especiais, como parênteses?

Parênteses ( e ) não são caracteres de palavra (\w).

Então, para o regex:

```regex
    \b(
```

O limite \b só pode existir se o caractere antes for \w e o próximo for não-\w (ou vice-versa).

Mas aqui temos o caractere (, que não é \w. Portanto, não existe limite de palavra antes de (.

## Como usar \b corretamente?
Use \b envolvendo caracteres que são de palavra, como:

- Números puros

- Palavras (letras/dígitos)

- Underscore _

Exemplo:

```regex
    \b12345\b
```
Casa o número 12345 isolado, mas não em 123456.

### Conclusão sobre a classe de caracter \b

\b casa posição entre caracteres.

Essa posição é entre caractere de palavra (\w) e não palavra (\W).

Não casa antes de símbolos como (, ), -, etc., pois eles são \W.

Por isso, para detectar números com parênteses, você não deve usar \b em volta dos parênteses, mas sim em volta dos dígitos.
