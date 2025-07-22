# Introdução 
Este arquivo tem como objetivo fazer uma anotação de entendimento a respeito de 
Quantificadores Gulosos e Não Gulosos, Alternância, Condicional (PCRE) e Lookarounds
para maximiar o uso do Regex em nossas aplicações.

**observações:** essa documentação vai servir de guia para os seguintes exercícios nos scripts.php:

- Quantificadores.php (1,2,3,4);
- operadoresLógicos.php (1,2);
- Lookrounds.php (1,2,3,4);

## Quantificadores Gulosos e Não Gulosos

### Quantificadores Gulosos (Greedy)

Definição: Tenta casar o máximo possível de caracteres que satisfaçam o padrão.

Exemplo:

```regex
    /a.*b/
```
Casa a sequência a até o último b possível.

### Quantificadores Não Gulosos (Lazy ou Reluctant)

Definição: Tenta casar o mínimo possível de caracteres que satisfaçam o padrão.

Sintaxe: Acrescenta ? após o quantificador.

Exemplo:
```regex
    /a.*?b/
```

Casa a sequência a até o primeiro b encontrado.

### Quantificadores Comuns

| Quantificador | Gulosidade | Significado                          |
| ------------- | ---------- | ------------------------------------ |
| `*`           | Gulosos    | 0 ou mais vezes                      |
| `+`           | Gulosos    | 1 ou mais vezes                      |
| `?`           | Gulosos    | 0 ou 1 vez                           |
| `{n,m}`       | Gulosos    | Entre n e m vezes                    |
| `*?`          | Não guloso | 0 ou mais vezes, o mínimo possível   |
| `+?`          | Não guloso | 1 ou mais vezes, o mínimo possível   |
| `??`          | Não guloso | 0 ou 1 vez, o mínimo possível        |
| `{n,m}?`      | Não guloso | Entre n e m vezes, o mínimo possível |


## Alternância = | — "IF OU ELSE" Simplificado (ternário) ou operador Lógico OU/OR

Descrição: O operador | funciona como um "OU" lógico na regex.

Sintaxe: (abc|def) casa "abc" ou "def".

Exemplo:

```regex
    /cat|dog/
```

Casa "cat" ou "dog".

### Condicional (PCRE) (?(id)true|false)

Descrição: Permite uma lógica condicional dentro da regex, baseado na existência de um grupo capturado.

Sintaxe: (?(id)exp1|exp2)
Onde id é o número ou nome do grupo, exp1 é o padrão a casar se o grupo existir, exp2 caso contrário.

Observação: Funciona apenas em engines que suportam PCRE, não é padrão em todas as implementações.

Exemplo:
```regex
    /(a)?(?(1)b|c)/
```

Casa "ab" se o grupo (a) existir, ou "c" se não existir.

## Lookaround (Olhar ao redor)

Lookarounds são mecanismos em regex que permitem verificar se um padrão está (ou não está) antes ou depois da posição atual, **sem consumir caracteres** na correspondência.

---

### Positive Lookahead `(?=...)`

- **Descrição:** Verifica se **logo após** a posição atual **existe** um padrão específico.
- **Sintaxe:** `X(?=Y)` — casa `X` apenas se for seguido por `Y`.
- **Exemplo:**

```regex
    foo(?=bar)
```

Casa a string "foo" somente se for seguida de "bar". Em "foobar" casa "foo", em "foobaz" não casa

### Negative Lookahead (?!...)

Descrição: Verifica se logo após a posição atual não existe um padrão específico.

Sintaxe: X(?!Y) — casa X apenas se não for seguido por Y.

Exemplo:

```regex
    foo(?!bar)
```

Casa "foo" apenas se não for seguida por "bar". Em "foobaz" casa, em "foobar" não casa.

### Positive Lookbehind (?<=...)

Descrição: Verifica se logo antes da posição atual existe um padrão específico.

Sintaxe: (?<=Y)X — casa X apenas se for precedido por Y.

Exemplo:

```regex
(?<=foo)bar
```

Casa "bar" somente se for precedido de "foo". Em "foobar" casa "bar", em "bazbar" não casa.

### Negative Lookbehind (?<!...)

Descrição: Verifica se logo antes da posição atual não existe um padrão específico.

Sintaxe: (?<!Y)X — casa X apenas se não for precedido por Y.

Exemplo:

```regex
(?<!foo)bar
```

Casa "bar" somente se não for precedido por "foo". Em "bazbar" casa, em "foobar" não casa.

## Resumo rápido

| Conceito            | Exemplo       | O que faz                             |                                       |
| ------------------- | ------------- | ------------------------------------- | ------------------------------------- |
| Positive Lookahead  | `foo(?=bar)`  | Casa "foo" só se vier "bar"           |                                       |
| Negative Lookahead  | `foo(?!bar)`  | Casa "foo" só se não vier "bar"       |                                       |
| Positive Lookbehind | `(?<=foo)bar` | Casa "bar" só se vier "foo" antes     |                                       |
| Negative Lookbehind | `(?<!foo)bar` | Casa "bar" só se não vier "foo" antes |                                       |
| Alternância         | \`cat         | dog\`                                 | Casa "cat" ou "dog"                   |
| Condicional (PCRE)  | \`(a)?(?(1)b  | c)\`                                  | Se grupo 1 existe casa "b", senão "c" |
| Guloso              | `a.*b`        | Casa o máximo possível                |                                       |
| Não guloso          | `a.*?b`       | Casa o mínimo possível                |                                       |

## Referência

Regex Lookaround (MDN) - https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions/Assertions

PCRE Conditional Patterns - https://www.pcre.org/current/doc/html/pcre2pattern.html#SEC12

Quantifiers in Regex - https://www.regular-expressions.info/repeat.html