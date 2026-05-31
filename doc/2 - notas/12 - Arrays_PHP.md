# Introdução 

Este documento visa explicar o que é um array, para que serve, como trabalhar, como iterar e usar funções fundamentais com a linguagem de programação PHP

OBSERVAÇÃO 1: Essa documentação é mais avançada, porém com paciência e estudos, vai dar para entender tranquilo.

OBSERVAÇÃO 2: Use o pesquisar do GitHub ou um CTRL + F para facilitar a navegação neste documento, pois tem muita informação específica rsrsrs

## O que é uma ARRAY?

No PHP, um Array é uma estrutura de dados composta, ordenada (na maioria dos casos) e indexada, que armazena múltiplos valores em uma única variável.

“Um Array é uma coleção de elementos (dados), cada um identificado por uma chave (índice), que pode ser um número ou uma string.”

array existe em: javascript, typescript, python, php e etc..

## Para que serve um Array? 

✔️ Armazenar múltiplos valores sob um mesmo nome de variável.
✔️ Organizar grandes quantidades de dados de forma acessível e manipulável.
✔️ Permitir operações em lote, como percorrer, filtrar, ordenar, agrupar, modificar ou buscar elementos.
✔️ Base para estruturas de dados mais avançadas: listas ligadas, filas, pilhas, matrizes, árvores, grafos — tudo pode ser representado via arrays em PHP.

### Relembradando estruturas de dados homogênea


1️⃣ O que significa estrutura de dados homogênea?

Homogênea:
    👉 Todos os elementos armazenados na estrutura são do mesmo tipo.

Exemplos clássicos:

    Um vetor de inteiros: int[10] em C.

    Um array de strings: ["ana", "bruno", "carla"].

    Uma matriz de floats: float[3][3].

✔️ Características:

    Tamanho fixo (em linguagens de tipagem estática).

    Tipagem forte.

    Fácil para operações matemáticas/vetoriais.

    Garante coerência: não há mistura de tipos.

2️⃣ E estrutura de dados heterogênea?

Heterogênea:
    👉 Permite elementos de tipos diferentes dentro da mesma estrutura.

Exemplos clássicos:

    Tuplas (tuple) em Python.

    Objetos (object) ou struct com campos de tipos mistos.

    Arrays PHP (porque não têm tipagem restrita).

✔️ Características:

    Flexível.

    Mais propenso a erros se mal usado.

    Muito comum em linguagens de script/dinâmicas.

### Comparação rápida

| Aspecto   | Homogênea                               | Heterogênea                                 |
| --------- | --------------------------------------- | ------------------------------------------- |
| Tipagem   | Único tipo de dado.                     | Vários tipos no mesmo container.            |
| Rigor     | Tipagem estática costuma reforçar isso. | Tipagem dinâmica é mais permissiva.         |
| Exemplo   | Vetor `int[]` em C                      | Array PHP com int, string, bool misturados. |
| Uso comum | Operações numéricas, matrizes, buffers. | Dados flexíveis, listas mistas, JSON.       |


### E no PHP?
👉 O array do PHP é, por natureza, heterogêneo.

Exemplo heterogêneo:

```php
<?php

$array = [10, "João", true, 3.14];

?>
```

Exemplo homogêneo:

```php
<?php

    $vetor = [1, 2, 3, 4]; // Todos inteiros.

?>
```

- OBSERVAÇÃO: 

    No PHP nada impede que você force homogeneidade por disciplina, mas o interpretador não impõe isso.
    Você pode misturar tipos no mesmo array — se misturar sem querer, seu script ainda roda, mas pode gerar bugs lógicos.


### Quando cada um é adequado?

| Situação                                                               | Homogêneo | Heterogêneo                                    |
| ---------------------------------------------------------------------- | --------- | ---------------------------------------------- |
| **Calcular médias, somar números, matrizes matemáticas**               | ✅         | 🚫 (desperdício, pois mistura não faz sentido) |
| **Representar um registro de dados variado (ex: dados de um usuário)** | 🚫        | ✅                                              |
| **JSON de API**                                                        | 🚫        | ✅                                              |
| **Tabela numérica**                                                    | ✅         | 🚫                                             |

### Resumo técnico 

| Pergunta               | Resposta                                         |
| ---------------------- | ------------------------------------------------ |
| **Homogênea?**         | Mesmo tipo de dado.                              |
| **Heterogênea?**       | Tipos mistos.                                    |
| **PHP permite ambos?** | Sim, mas só reforça se você quiser (documente!). |
| **Por que importa?**   | Evita bugs e garante coerência de dados.         |


## Array é igual a Matriz?

Nem sempre!

Todo vetor (array unidimensional) é um array, mas nem todo array é uma matriz.
E matriz, em termos formais, é um array multidimensional, especificamente organizado em linhas e colunas — ou seja, dimensão 2 ou mais.


## Diferença conceitual (Array e Matriz )

| Conceito             | Definição                                                                                                                                  |
| -------------------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| **Array (ou Vetor)** | Estrutura de dados **unidimensional**: uma lista linear de elementos, cada um identificado por um índice. Ex: `[1, 2, 3, 4]`.              |
| **Matriz**           | Estrutura de dados **bidimensional** (ou mais): elementos organizados em **linhas e colunas**. Ex: tabela `[ [1,2,3], [4,5,6], [7,8,9] ]`. |



## O que significa “dimensão” em arrays ou matrizes?

| Termo                | Definição                                                                                                 |
| -------------------- | --------------------------------------------------------------------------------------------------------- |
| **Unidimensional**   | Precisa de **1 índice** para acessar cada elemento.                                                       |
| **Bidimensional**    | Precisa de **2 índices** — um para **linha**, outro para **coluna**.                                      |
| **Multidimensional** | Precisa de **2 ou mais índices** — por exemplo, 3 índices (ex: matriz 3D), 4 índices (ex: matriz 4D) etc. |


##  📏 Matriz Unidimensional

Definição:

    É simplesmente um vetor, ou array simples.
    Cada elemento é acessado por um único índice.

Exemplo: 

```php
<?php
    $vetor = [10, 20, 30, 40];
e   cho $vetor[2]; // 30
?>
```
✔️ Analogia: lista de nomes, lista de números.


## 🧮 Matriz Bidimensional

Definição:

    É uma tabela, com linhas e colunas.
    Você precisa de dois índices: [linha][coluna].

Exemplo PHP:

```php
<?php
    $matriz = [
        [1, 2, 3], // linha 0
        [4, 5, 6], // linha 1
        [7, 8, 9]  // linha 2
    ];

    echo $matriz[1][2]; // 6 (linha 1, coluna 2)
?>
```

🧊 Matriz Multidimensional


Definição:
    É uma extensão do conceito:

    3D → precisa de 3 índices: [x][y][z]

    4D → precisa de 4 índices: [a][b][c][d]

    E assim por diante…

Na prática, cada “nível” de índice aninha mais um array dentro de outro.

Exemplo PHP:

```php
<?php
    $matriz3D = [
        [   // camada 0
            [1, 2],
            [3, 4]
        ],
        [   // camada 1
            [5, 6],
            [7, 8]
        ]
    ];

    // Acessar elemento na camada 1, linha 0, coluna 1
    echo $matriz3D[1][0][1]; // 6
?>
```

✔️ Analogia: cubo de pixels (imagem 3D), coordenadas espaciais, modelos complexos como jogos ou ciência de dados.

### ⚙️ PHP suporta todos?

✅ Sim!
No PHP, não existe limite prático para o nível de aninhamento, desde que você tenha memória disponível.

Porém:

Para 1D e 2D → usa-se muito.

Para 3D ou mais → É raro em PHP puro. Geralmente manipulado em frameworks, extensões de processamento de imagem, ciência de dados, ou usando bibliotecas específicas.

## Qual é a diferença entre Array, Lista e Vetor?

Aqui é importante entender que essas palavras são parecidas, mas não são sinônimos absolutos, principalmente quando você migra de teoria de estrutura de dados para a prática em PHP.

| Termo     | Significado Teórico                                                                                                                                                                                                 | No PHP                                                                                                                                       |
| --------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------- |
| **Array** | Estrutura de dados geral que armazena **elementos indexados**. Pode ser **associativo** (índices strings) ou **numérico** (índices inteiros).                                                                       | É **versátil**: suporta **arrays associativos**, **arrays numéricos** e **arrays multidimensionais**.                                        |
| **Lista** | Normalmente, uma coleção **ordenada**, **mutável**, onde elementos são armazenados em sequência lógica. Em algumas linguagens é diferente de array porque **não é indexada por posição fixa** (ex: listas ligadas). | Em PHP não existe `List` como estrutura nativa separada. Usa-se `array` para isso.                                                           |
| **Vetor** | Um **array unidimensional**, normalmente **somente de mesmo tipo de dado**, indexado numericamente, com tamanho fixo ou dinâmico dependendo da linguagem.                                                           | No PHP é **um array com índices numéricos sequenciais** — nada impede de misturar tipos, mas **conceitualmente** um “vetor” seria homogêneo. |


💡 Resumo prático:

No PHP, Array cobre tudo. Não existe estrutura separada Vector ou List. A diferença é conceitual: quando o array só tem índices numéricos e elementos do mesmo tipo, você está tratando como vetor; se usa índices numéricos sequenciais, funciona como lista; se mistura índices string, vira array associativo.

## Comparação com outras linguagens

🔹 Em linguagens como C, Java, C++:

Array: tamanho fixo, tipo fixo.

Lista (List): tamanho dinâmico, geralmente implementada como classe.

Vetor (Vector): em Java é uma classe Vector (thread-safe, dinâmica).

🔹 Em PHP, o array é flexível:

Pode crescer ou diminuir.

Aceita tipos mistos.

Índices podem ser numéricos ou strings.

## ✅ Ponto importante: por que isso importa?

PHP é altamente dinâmico. Por isso, saber o que é um array em nível conceitual evita armadilhas, como:

    Misturar índices numéricos e strings sem querer.

    Criar buracos na sequência de índices.

    Lidar com funções que exigem arrays indexados ou associativos de forma específica


## Manipulação de arrays 

### Criação de Arrays

- 1 Array Unidimensional (Vetor)
Um array unidimensional é uma sequência linear de elementos.
No PHP, usamos colchetes [] para declarar.

```php
<?php

<?php

    // Cria um array com quatro números inteiros
    $numeros = [10, 20, 30, 40];

    // Exibe o conteúdo
    print_r($numeros);

    /*
    Saída:
    Array
    (
        [0] => 10
        [1] => 20
        [2] => 30
        [3] => 40
    )
    */
?>
```

Explicação:

    Cada elemento tem um índice numérico (automático): 0, 1, 2, 3.

Você pode definir explicitamente:

```php
<?php

    $numeros = [0 => 10, 1 => 20, 2 => 30, 3 => 40];

    // elemento de índice 0 terá o valor 10 atribuido a ele neste array unidimensional/vetor
?>
```

- 2 Array Associativo
Um array associativo usa strings como chaves (índices). É muito usado em PHP para representar dados com significado.

```php
<?php

    $usuario = [
        "id" => 1,
        "nome" => "Carlos",
        "idade" => 28
    ];

    print_r($usuario);

    /*
    Saída:
    Array
    (
        [id] => 1
        [nome] => Carlos
        [idade] => 28
    )
    */
?>

```
🔍 Explicação:

    Cada par chave => valor forma um campo.

    Usado para dados de usuário, configurações, JSON, etc.

- 3 Array Multidimensional
Um array multidimensional é um array que contém outros arrays.

```php
<?php
    $matriz = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
    ];

    print_r($matriz);

    /*
    Saída:
    Array
    (
        [0] => Array
            (
                [0] => 1
                [1] => 2
                [2] => 3
            )

        [1] => Array
            (
                [0] => 4
                [1] => 5
                [2] => 6
            )

        [2] => Array
            (
                [0] => 7
                [1] => 8
                [2] => 9
            )
    )
    */
?>
```

🔍 Explicação:

    Cada linha é um array.

    Para acessar um valor: $matriz[linha][coluna].


### Acessando Elementos de Arrays

- 1 Acessar por Índice Numérico

```php
<?php
    echo $numeros[2]; // 30
?>
```
Lê-se: “Pegue o terceiro elemento do vetor $numeros”


- 2 Acessar por Chave Associativa

```php
<?php
    echo $usuario["nome"]; // Carlos
?>
```

- 3  Acessar Matriz

```php
<?php

    echo $matriz[1][2]; // 6 (linha 1, coluna 2)
?>
```

### Adicionando Elementos Array

- 1 Adicionar no Final

```php
<?php
    $numeros[] = 50; // Adiciona 50 na próxima posição
    print_r($numeros);
?>
```

- 2 Adicionar com Índice Específico

```php
<?php
    $usuario["email"] = "carlos@email.com";
    print_r($usuario);
?>
```

### Removendo Elementos do Array

- 1 usando o método unset()

```php
<?php

    unset($numeros[1]); // Remove o elemento no índice 1
    print_r($numeros);
?>
```

Atenção!
unset() não reorganiza os índices. Se quiser reindexar:

```php
<?php
    $numeros = array_values($numeros);
?>
```

###  Percorrendo Arrays

- 1 foreach

```php
<?php
    foreach ($usuario as $chave => $valor) {
        echo "$chave => $valor\n";
    }

    /*
    id => 1
    nome => Carlos
    idade => 28
    email => carlos@email.com
    */
?>
```

Obs.: foreach é seguro para percorrer arrays associativos ou numéricos.

- 2 for tradicional

Útil para arrays indexados numericamente.

```php
<?php

    for ($i = 0; $i < count($numeros); $i++) {
        echo $numeros[$i] . "\n";
    }
?>
```

## Funções Fundamentais de Manipulação

- array_push()
Adiciona um ou mais elementos no final do array.

```php
<?php

    array_push($numeros, 60, 70);
    print_r($numeros);
?>
```

- array_pop()
Remove e retorna o último elemento.

```php
<?php

    $ultimo = array_pop($numeros);
    echo "Removido: $ultimo\n";
    print_r($numeros);
?>
```
- array_shift()
Remove o primeiro elemento.

```php
<?php
    $primeiro = array_shift($numeros);
    echo "Primeiro removido: $primeiro\n";
    print_r($numeros);
?>
```

- array_unshift()
Adiciona um ou mais elementos no início.

```php
<?php
    array_unshift($numeros, 5);
    print_r($numeros);
?>
```

## Funções de Pesquisa e Filtragem

- in_array()
Verifica se um valor existe.

```php
<?php

    if (in_array(30, $numeros)) {
        echo "30 está no array.\n";
    }
?>
```

- array_search()
Retorna o índice de um valor, se existir.

```php
<?php

    $indice = array_search(30, $numeros);
    echo "Índice de 30: $indice\n";
?>
```

## Funções de Ordenação

- sort()
Ordena valores e reindexa.

```php
<?php

    sort($numeros);
    print_r($numeros);
?>
```

- asort()
Ordena mantendo os índices.

```php
<?php

    asort($usuario); // Ordena valores, chaves permanecem
    print_r($usuario);
?>
```

- ksort()
Ordena pelas chaves.

```php
<?php
    ksort($usuario);
    print_r($usuario);
?>
```

## Funções de Mapear e Filtrar

- array_map()
Aplica uma função a cada elemento.

```php
<?php

    $dobros = array_map(fn($n) => $n * 2, $numeros);
    print_r($dobros);
?>
```

- array_filter()
Filtra elementos.

```php
<?php

    $pares = array_filter($numeros, fn($n) => $n % 2 === 0);
    print_r($pares);
?>
```

## Trabalhando com Matrizes (Bidimensionais)

- Percorrer toda a matriz

```php
<?php

    foreach ($matriz as $linha) {
        foreach ($linha as $coluna) {
            echo $coluna . " ";
        }
        echo "\n";
    }

    /*
      1 2 3 
    */
?>
```

## Conclusão

✔️ O PHP oferece uma API enorme para manipular arrays de forma poderosa.
✔️ Aprender a usar foreach, funções de ordenação, map/filter, e saber quando reindexar é essencial.
✔️ Para projetos sérios, combine arrays com tipagem PHPDoc ou validação, principalmente em arrays heterogêneos.

