# Introdução 
Este arquivo tem como objetivo fazer uma anotação de entendimento a respeito de 
Operadores Literais, Operadores de Escape, Conjunto de Caracteres e Classes de Caracteres

**observações:** essa documentação vai servir de guia para os seguintes exercícios nos scripts.php:

- operadoresLiterais.php (1,2);
- CaracteresEscape.php (1,2);
- IniciaLinhaFimLinha.php;

## Operadores Literais

**Definição:**  
Na expressão regular, **literais** são caracteres comuns — letras, dígitos, símbolos — que **não têm significado especial** para o motor regex, ou seja, são interpretados **exatamente como aparecem**.

**Exemplos de literais:**  
- `/a/` → casa o caractere `a`.
- `/dog/` → casa a sequência exata `dog`.
- `/2025/` → casa a string `2025`.

**Quando usar:**  
Sempre que você quiser **procurar texto fixo**, sem metacaracteres ou modificadores.

---

## Operadores de Escape (`\`)

**Definição:**  
Em regex, certos caracteres possuem **significado especial** (metacaracteres), como `. ^ $ * + ? { } [ ] ( ) | \`.  
Para **tratar esses caracteres como literais**, você precisa **escapar** usando a barra invertida `\`.

**Exemplos:**

| Padrão | Significado |
|--------|--------------|
| `\.`   | Casa ponto literal `.` em vez de \"qualquer caractere\" |
| `\\$`  | Casa símbolo `$` literal em vez de \"fim da linha\" |
| `\\(`  | Casa parêntese de abertura literal |
| `\\|`  | Casa o pipe `|` literal em vez de alternância | (OU/OR)

**Exemplo prático:**  
```regex
    /www\.exemplo\.com/
```

Casa exatamente: www.exemplo.com

Lembrando que /.../ são os delimitaadores, ele delimitam o bloco de instrução do nosso regex, basicamente é o {...} do php ou do java, typescript,javascript.

## Conjunto de Caracteres [...]

Definição:

Um conjunto de caracteres (Character Set) é delimitado por [ e ]. Ele casa um único caractere, que pode ser qualquer um dos listados.

Exemplos:

- [abc] → casa a ou b ou c.

- [A-Z] → casa qualquer letra maiúscula de A a Z.

- [0-9] → casa qualquer dígito de 0 a 9.

- [A-Za-z] → casa qualquer letra maiúscula ou minúscula.

- [^abc] → ^ dentro do conjunto nega → casa qualquer caractere exceto a, b ou c.

Exemplo: 

```regex
/gr[ae]y/
```
Casa gray ou grey.

## Classes de Caracteres \w \d \s (Predefinidas)

Definição:

As classes de caracteres são atalhos para conjuntos comuns. Começam com \ e representam grupos úteis.

| Classe | Equivalência    | Significado                                             |
| ------ | --------------- | ------------------------------------------------------- |
| `\w`   | `[A-Za-z0-9_]`  | Letra, dígito ou underscore                             |
| `\W`   | Negação de `\w` | Qualquer caractere que **não seja** `\w`                |
| `\d`   | `[0-9]`         | Dígito de 0 a 9                                         |
| `\D`   | Negação de `\d` | Qualquer caractere que **não seja** dígito              |
| `\s`   | `[ \t\r\n\f]`   | Qualquer espaço em branco (space, tab, quebra de linha) |
| `\S`   | Negação de `\s` | Qualquer caractere que **não seja** espaço em branco    |

Exemplos práticos:

- \d\d\d → casa três dígitos (123, 456).

- \w+ → casa uma palavra (sequência de letras, números ou _).

- \s → casa um espaço ou tabulação.

## Dica Avançada

Escape dentro de []

Dentro de conjuntos, a maioria dos metacaracteres não precisa ser escapada, exceto ], - (às vezes) e ^ se não for no início.

Exemplo:

[a\-z] → casa a, - ou z.

## Exemplo Final:

```regex
    [A-Z]\w+\s\d{4}
```

Lê-se:

- [A-Z] → letra maiúscula

- \w+ → uma ou mais letras, dígitos ou _

- \s → um espaço

- \d{4} → exatamente 4 dígitos

Exemplo válido: AUser 2025

## Resumo Geral 

| Conceito             | Símbolo  | Significado                 |
| -------------------- | -------- | --------------------------- |
| Literal              | `dog`    | Casa `dog` literal          |
| Escape               | `\.`     | Casa ponto `.` literal      |
| Conjunto             | `[abc]`  | Casa `a`, `b` ou `c`        |
| Conjunto Negado      | `[^abc]` | Casa tudo, exceto `a/b/c`   |
| Classe de Caracteres | `\w`     | Letra, dígito ou `_`        |
| Classe Negada        | `\W`     | Não letra/dígito/underscore |


## Referências

MDN Regex Guide - https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions

Regex101 Cheatsheet - https://regex101.com/
