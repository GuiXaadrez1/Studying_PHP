# Introdução 
Este arquivo.md tem como objetivo demonstrar os princiapis tipos de dados do PHP afim de facilitar os estudos

## Tipos de Dados em PHP

Esta tabela resume os principais tipos de dados do PHP, suas descrições, exemplos práticos e observações úteis para uso em scripts, funções e sistemas robustos.

| Tipo de Dado  | Descrição                                 | Exemplo PHP                           | Observação Importante                                      |
|---------------|-------------------------------------------|---------------------------------------|------------------------------------------------------------|
| `int`         | Número inteiro (positivo, negativo ou zero) | `$idade = 30;`                        | Limite depende do sistema: 32 ou 64 bits.                 |
| `float` (`double`) | Número de ponto flutuante               | `$altura = 1.75;`                     | Use `.` como separador decimal, não use `,`.               |
| `string`      | Cadeia de caracteres                      | `$nome = "João";`                     | Pode usar aspas simples `' '` ou duplas `" "`.             |
| `bool`        | Valor booleano (verdadeiro ou falso)      | `$ativo = true;`                      | `true` ou `false` (case-insensitive).                      |
| `array`       | Coleção indexada de valores               | `$frutas = ["maçã", "banana"];`       | Pode ser indexado numericamente ou associativo.            |
| `object`      | Instância de classe (objeto)              | `$obj = new MinhaClasse();`           | Define estrutura de dados customizada com métodos.         |
| `null`        | Valor nulo, ausência de valor             | `$valor = null;`                      | Útil para inicializar variáveis que não têm valor inicial. |
| `resource`    | Referência para recurso externo           | `$arquivo = fopen("arq.txt", "r");`   | Manipula conexões, streams, sockets, etc.                  |
| `callable`    | Função anônima ou callback                | `$fn = function() { echo "Oi"; };`    | Usado para passar funções como argumento.                  |
| `mixed`       | Valor que pode ser de qualquer tipo       | `function x(mixed $param) {}`         | Novo suporte em PHP 8.0 para tipagem.                      |
| `iterable`    | Qualquer estrutura percorrível            | `function x(iterable $it) {}`         | Inclui arrays e objetos que implementam Iterator.          |

---

## ⚡ Notas Rápidas

- **Tipagem dinâmica:** O PHP é fracamente tipado, mas desde PHP 7+ é possível tipar parâmetros e retornos.
- **Casting:** Você pode converter tipos explicitamente com `(int)`, `(float)`, `(string)` etc.
- **Funções úteis:** `gettype()`, `var_dump()`, `is_int()`, `is_array()`, `is_object()`.

---

## 📚 Exemplo de uso

```php
<?php
    $idade = 25;              // int
    $altura = 1.82;           // float
    $nome = "Maria";          // string
    $ativo = true;            // bool
    $frutas = ["maçã", "pêra"]; // array
    $obj = new stdClass();    // object
    $valor = null;            // null

    var_dump($idade, $altura, $nome, $ativo, $frutas, $obj, $valor);
?>
```

## Tipagem de Parâmetros e Retorno

Desde o PHP 7+, você pode (e deve) usar **type hints** e `: tipo` para declarar o tipo de retorno.

- Exemplo 1: Função com `int` e `float`

```php
<?php
    //             tipagem no parâmetro     tipagem no retorno
    function somaInteiros(int $a, int $b): int {
        return $a + $b;
    }

    function dividir(float $a, float $b): float {
        if ($b === 0.0) {
            throw new Exception("Divisão por zero não permitida");
        }
        return $a / $b;
    }

    echo somaInteiros(10, 20); // 30
    echo dividir(10.0, 2.0);   // 5.0
?>
```

- Exemplo 2: Tipagem com array e string

```php
<?php
    function juntarNomes(array $nomes): string {
        return implode(", ", $nomes);
    }

    $lista = ["Maria", "João", "Ana"];
    echo juntarNomes($lista); // Maria, João, Ana
?>
```

- Exemplo 3: Tipagem com object e ? (nullable)

```php
<?php
    class Pessoa {
        public string $nome;

        public function __construct(string $nome) {
            $this->nome = $nome;
        }
    }

    function pegarNome(?Pessoa $pessoa): string {
        return $pessoa ? $pessoa->nome : "Desconhecido";
    }

    $p = new Pessoa("Guilherme");
    echo pegarNome($p);      // Guilherme
    echo pegarNome(null);    // Desconhecido
?>
```
## Casting (Conversão Explícita)
Em PHP, você pode forçar a conversão de tipos usando (tipo). Exemplo:

```php
<?php
    $numeroString = "42";
    $numeroInt = (int) $numeroString;  // string → int

    $numeroFloat = 42.75;
    $numeroInt2 = (int) $numeroFloat;  // float → int (perde casas decimais)

    $boolZero = (bool) 0;     // int → bool (false)
    $boolUm = (bool) 1;       // int → bool (true)

    echo $numeroInt;   // 42
    echo $numeroInt2;  // 42
    echo $boolZero;    // (vazio, pois false)
    echo $boolUm;      // 1
?>
```

## Funções Utéis para inspeção, teste, debugs, refatoração em variáveis, retornos, classes

| Função        | O que faz                                  |
| ------------- | ------------------------------------------ |
| `gettype()`   | Retorna o tipo de uma variável.            |
| `var_dump()`  | Mostra tipo + valor + estrutura completa.  |
| `is_int()`    | Verifica se é inteiro (`true` ou `false`). |
| `is_float()`  | Verifica se é float.                       |
| `is_string()` | Verifica se é string.                      |
| `is_bool()`   | Verifica se é booleano.                    |
| `is_array()`  | Verifica se é array.                       |
| `is_object()` | Verifica se é objeto.                      |
| `is_null()`   | Verifica se é null.                        |

- Exemplo de uso:

```php
<?php
    $variavel = 123.45;

    echo gettype($variavel); // double
    var_dump($variavel);     // float(123.45)

    if (is_float($variavel)) {
        echo "É um float!";
    }
?>
```

## Dicas Pro Avançadas

- declare(strict_types=1); no topo do arquivo força coerção estrita → bom para projetos grandes.
- Desde PHP 8, você pode usar mixed para aceitar qualquer tipo:

```php
<?php
    function exemplo(mixed $entrada): mixed {
        return $entrada;
    }
?>
```
- iterable é aceito como array ou Iterator.

## Referências

PHP Manual - https://www.php.net/manual/pt_BR/language.types.php

PHP Manual - https://www.php.net/manual/pt_BR/functions.arguments.php#functions.arguments.type-declaration