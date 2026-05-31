## 📘 1. Introdução

Em linguagens orientadas a objetos, compreender o modelo de memória dos objetos é fundamental para evitar comportamentos inesperados, especialmente quando múltiplas variáveis parecem “apontar” para o mesmo objeto.

No PHP, objetos são manipulados por referência por padrão, o que significa que duas variáveis podem representar o mesmo objeto na memória.

No entanto, a linguagem fornece o operador clone para criar cópias profundas (shallow ou deep, dependendo da implementação) dos objetos — permitindo a duplicação sem compartilhamento de referência.

## Modelo de Referência em PHP

### Declaração de Objetos

Quando criamos um objeto com o operador new, o PHP aloca memória no heap para essa instância e armazena apenas uma referência na variável

```php

// materializando um objeto da class Gato em uma variável ("espaço de alocação na memória ram")
$gato1 = new Gato(true, true, true, true);

// gato2 é uma variável que faz referÊncia (aponta) para a variável gato1
// ao qual está o nosso objeto
$gato2 = $gato1;
```

Neste momento, $gato1 e $gato2 não são cópias diferentes.
Eles apontam para o mesmo endereço de memória (o mesmo objeto).

Portanto:

```php
// atribuir valor falso a propriedade boca do gato2
$gato2->boca = false;

// muda também o valor da propriedade boca do gato1
echo $gato1->boca; // false
```

Mesmo alterando $gato2, o $gato1 muda — porque ambos compartilham o mesmo ponteiro para alocação de memória ao qual está o objeto Gato materializado.

```bash
variável gato1 apontando -----> 0100101 <----- variável gato2

0100101 == lugar ao qual o objeto da class gato foi alocado
```

## Clonagem de Objetos

A partir do PHP 5, a linguagem introduziu o operador clone, cuja função é criar uma nova instância (novo endereço na memória) baseada no estado atual de outro objeto.

```php
$gato1 = new Gato(true, true, true, true);
$gato2 = clone $gato1;
```

Agora:

- $gato2 é um novo objeto.

- $gato1 e $gato2 ocupam endereços diferentes na memória.

Suas propriedades são copiadas (shallow copy).

**Mudanças em um não afetam o outro:**

```php
$gato2->boca = false;
echo $gato1->boca; // true
```

## Como o clone Funciona Internamente

O operador clone:

- Cria uma nova instância da classe do objeto original.

- Copia todas as propriedades acessíveis (públicas, protegidas e privadas).

- Executa, se existir, o método mágico __clone() do objeto.

### Exemplo:

```php
class Gato {
    public bool $boca;

    public function __clone() {
        echo "Objeto Gato foi clonado com sucesso!";
    }
}

$gato1 = new Gato();
$gato2 = clone $gato1;
```

**Esse método é útil para controlar como as propriedades devem ser copiadas (por exemplo, se houver objetos dentro de objetos).**

## Diferença entre Atribuição por referência e clonagem

| Operação               | Efeito                 | Compartilha Memória? | Executa `__clone()`? |
| ---------------------- | ---------------------- | -------------------- | -------------------- |
| `$obj2 = $obj1;`       | Atribui uma referência | ✅ Sim                | ❌ Não                |
| `$obj2 = clone $obj1;` | Cria um novo objeto    | ❌ Não                | ✅ Sim                |

## Exemplo prátio:

```php
$objetoGato = new Gato(true,true,true,true);
$objetoGato2 = new Gato(false,true,true,false);

$objetoGato2 = clone $objetoGato;
echo($objetoGato2->boca); // true
```

Antes da linha clone, $objetoGato2 era uma instância independente.

Após clone, o objeto de $objetoGato é copiado e atribuído a $objetoGato2.

Agora $objetoGato2 é uma cópia completa de $objetoGato, com os mesmos valores, mas endereços de memória diferentes.

🔍 Em termos técnicos: o PHP cria uma shallow copy, ou seja, apenas os valores escalares (bool, int, string) são duplicados.

Se houvesse propriedades que fossem outros objetos, elas ainda apontariam para o mesmo objeto interno (a menos que você implemente uma cópia profunda no método __clone()).

## Comparando Referência e Clonagem

| Conceito   | Comportamento                       | Resultado Esperado           |
| ---------- | ----------------------------------- | ---------------------------- |
| Referência | Compartilha a mesma área de memória | Alterações refletem em ambos |
| Clonagem   | Cria uma nova instância idêntica    | Alterações independentes     |


## Considerações de Engenharia de Software

A decisão entre referenciar ou clonar deve ser estratégica:

- Use referência quando deseja manipular o mesmo estado compartilhado (ex: Singleton, Repository).

- Use clonagem quando precisa preservar o estado original (ex: Padrão Prototype, Snapshot, Undo).

## Padrão de Projeto Relacionado

Esse comportamento é frequentemente usado no Design Pattern Prototype, onde um objeto existente serve como modelo para gerar novas instâncias sem invocar o construtor original.

```php
class GatoPrototype extends Gato {
    public function __clone() {
        $this->boca = true; // reconfigura valores ao clonar
    }
}
```

## Conclusão

A referência e clonagem de objetos no PHP são conceitos essenciais para o controle de memória e de estado.

Compreender como o PHP lida com endereçamento e cópia é determinante para criar sistemas robustos, especialmente em arquiteturas complexas que manipulam múltiplas instâncias de entidades inter-relacionadas.