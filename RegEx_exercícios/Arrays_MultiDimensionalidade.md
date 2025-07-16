# Intodução
Este documento tem como principal objetivo ser um Guia paras as Dimensões de Arrays

## ✅ 1️⃣ O que é um Array Unidimensional

Um **array unidimensional** é uma **lista linear** de valores. Cada valor é acessado por **um único índice**.

**Exemplo:**

```php
$numeros = [10, 20, 30, 40, 50];

//acessando valor específico do vetor, lista pelo index
echo $numeros[2]; // Saída: 30
```

## ✅ 2️⃣ O que é um Array Bidimensional

Um **array bidimensional** é uma **matriz** (tabela) de linhas e colunas. É basicamente um array de arrays.

**Exemplo:**

```php
$matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

// acessando um valor específico da matriz, array de array pelo index de cada array
echo $matriz[1][2]; // Saída: 6
```

Aqui:

* `1` → Linha 2 (índice 1)
* `2` → Coluna 3 (índice 2)

## ✅ 3️⃣ O que é um Array Multidimensional

Um **array multidimensional** é um array que contém **arrays dentro de arrays**, formando várias dimensões.

**Exemplo:**

```php
$multi = [
    [
        [1, 2, 3],
        [4, 5, 6]
    ],
    [
        [7, 8, 9]
    ]
];

// acessando um valor específico pelo index de cada array 1,2,3
echo $multi[0][1][2]; // Saída: 6
```

Explicando:

* `[0]` → Primeiro bloco
* `[1]` → Segunda linha dentro do bloco
* `[2]` → Terceiro valor dentro da linha

## ✅ 4️⃣ Slicing em Arrays no PHP

PHP **não tem um operador de slice nativo como Python**, mas usa a função **`array_slice`** para isso.

**Exemplo unidimensional:**

```php
$nums = [10, 20, 30, 40, 50];
$fatias = array_slice($nums, 1, 3);
print_r($fatias); // Saída: [20, 30, 40]
```

* `1` → índice de início
* `3` → quantidade de elementos

**Exemplo bidimensional:**

```php
$matriz = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

$linha_fatiada = array_slice($matriz[1], 1, 2);
print_r($linha_fatiada); // Saída: [5, 6]
```

## ✅ 5️⃣ Como Iterar

### 🔹 Unidimensional

```php
$lista = ["a", "b", "c"];
foreach ($lista as $valor) {
    echo $valor . PHP_EOL;
}
```

### 🔹 Bidimensional

```php
$matriz = [
    [1, 2],
    [3, 4]
];

foreach ($matriz as $linha) {
    foreach ($linha as $coluna) {
        echo $coluna . PHP_EOL;
    }
}
```

### 🔹 Multidimensional

```php
$multi = [
    [[1, 2]],
    [[3, 4, 5]]
];

foreach ($multi as $bloco) {
    foreach ($bloco as $linha) {
        foreach ($linha as $valor) {
            echo $valor . PHP_EOL;
        }
    }
}
```

## ⚡ Dica Final

* Arrays mais profundos exigem loops aninhados.
* Para debugar, use `print_r()` ou `var_dump()` para ver a estrutura.
* Para slices, sempre use `array_slice`.

Pronto! Agora você domina **arrays de qualquer dimensão** em PHP 🚀
