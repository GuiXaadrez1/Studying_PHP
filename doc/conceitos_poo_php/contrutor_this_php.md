# Método construtor e $this-> (Explicação na linguagem PHP e Java)

## Introdução
Este arquivo.md tem como principal objetivo registrar e entender como funciona o método mágico construtor e a convenção de instância atual do objeto ou class conhecido como $this.

## O que é um método construtor

O método construtor é uma função especial dentro de uma classe que é executada automaticamente no momento em que um objeto é criado (instanciado). Essa função 
SEMPRE deve ser public

### Exemplo em PHP:

```php
<?php
    # Criando a class Pessoa (Estrutura, escopo, esqueleto do nosso futuro objeto)
    class Pessoa {

        # Definindo atributos, propriedades da classe de forma global, for do construtor
        public $nome;
        public $idade;

        # Criando o método construtor
        public function __construct($nome, $idade) {
            $this->nome = $nome;
            $this->idade = $idade;
        }
    }

    # materializando um objeto da classe Pessoa
    $pessoa1 = new Pessoa();

    # acessando um atributo ou método do nosso objeto com a seta (->) e atribuindo um novo valor

    $pessoa1->nome="Guilherme";

?>
```

### Exemplo em Java

```java

// Criando class no java
class Pessoa {

    // Definido as propriedades com suas devidas tipagens 
    String nome;
    int idade;

    // Defininfo um  método construtor com parâmetros e referenciar cada parâmetro 
    // a uma propriedade para ser definidas dinâmicamente na hora de instânciar 
    // um objeto da classe Pessoa com Java

    Pessoa(String nome, int idade) {
        this.nome = nome;
        this.idade = idade;
    }

    // definindo um método

    void mostrar() {
        System.out.println(this.nome + " - " + this.idade);
    }
}

// Definindo a nossa class principal ao qual o jvm vai executar o nosso código
public class Main {
    public static void main(String[] args) {
        Pessoa p = new Pessoa("Carlos", 25);
        p.mostrar();
    }
}
```

## O que é o $this-> e como ele se relaciona com o this do java?

No PHP, o $this-> - **é uma refência automática do objeto atual (a instância da classe) dentro do contexto não estático**. 

O acesso a membros de instância é feito com  seta (->).

O mesmo contexto vale para o this. do Java, o que mudo é que para acessar um atributo ou método usamos o ponto final.

Em outras palavras: 

    $this aponta para o objeto que está executando o método ou o atributo.

Observações: 

    $this-> funciona em interface também para acessar um método ou atributo, funciona como uma class abastrata

**LEMBRANDO:**

    $this-> você vai conseguir ter acesso as propriedades e atributos de uma classe, desde que ela esteja dentro do arquivo, caso esteja em arquivos diferentes, você deve importar a class ou fazer uma herança

### Exemplo em PHP

```php
<?php
# criando class
class Pessoa {

    #definindo atributo
    public $nome;

    # criando método
    public function mostrarNome() {
        # acessando atributo 
        echo $this->nome;
    }
}

// Materializando o objeto da class
$p = new Pessoa();

// acessando um atributo do objeto materializado e colocando valor nela

$p->nome = "Guilherme";

// acessando o método mostrarNome() do objeto materializado

$p->mostrarNome(); 

// Saida: "Guilherme"

?>
```
➡️ $this dentro de mostrarNome() aponta para o mesmo objeto $p.

## Como funciona o Parâmetro do construtor e a sua relação com this./$this->

No Java, o this é usado para diferenciar os atributos da classe dos parâmetros do construtor, quando possuem o mesmo nome:

```java
class Pessoa {
    String nome;
    Pessoa(String nome) {
        this.nome = nome;
    }
}
```
➡️ this.nome → atributo da classe

➡️ nome → parâmetro loca

O mesmo ocorre no PHP, com $this->:

```php
<?php
class Pessoa {
    public $nome;
    public function __construct($nome) {
        $this->nome = $nome;
    }
}
?>
```

$this->nome → propriedade do objeto
➡️ $nome → parâmetro recebido

### 🔄 Comparação direta

| Conceito                            | Java                                              | PHP                            |
| ----------------------------------- | ------------------------------------------------- | ------------------------------ |
| Nome do parâmetro igual ao atributo | `this.atributo = atributo;`                       | `$this->atributo = $atributo;` |
| Motivo do uso do this               | Evitar ambiguidade e acessar o atributo do objeto | Mesmo motivo                   |
| Contexto de execução                | No momento da construção                          | No momento da construção       |


## Como funciona os $this-> (lembre-se do this.parâmetro_referência) como e sem construtor

Toda classe em Java tem um construtor implícito. Mesmo que você não crie um construtor, a JVM cria um construtor padrão automaticamente.

Exemplos em java:

```java
class Pessoa {
    String nome;
    int idade;
}
```

Esse construtor padrão não inicializa nada, apenas cria o objeto em memória.
Mas o this ainda existe dentro dele — apenas você não o vê porque o construtor é implícito.

➡️ Internamente, o compilador gera algo equivalente a:

Exemplo em java:

```java
class Pessoa {
    String nome;
    int idade;

    Pessoa() {
        super(); // chama o construtor da classe pai (Object)
    }
}
```

Neste contexto o mesmo vale para o PHP

Exemplo em PHP:

```php
<?php
    class Pessoa {
    public $nome;
    public $idade;
}
?>
```

➡️ Internamente, o PHP faz algo equivalente a:

```php
<?php
class Pessoa {
    public $nome;
    public $idade;

    public function __construct() {
        // construtor padrão (implícito)
        // não inicializa nada
        // mas o $this já existe
    }
}
?>
```
Esse construtor padrão não atribui valores nem executa lógica,
mas o $this já está disponível dentro dele — você só não o vê porque o construtor é implícito.

### O this existe em qualquer método de instância

Quando você cria o objeto:

```java
Pessoa p = new Pessoa();
```

A JVM: 

Cria o objeto Pessoa em memória; 
Associa this àquele objeto; 
Executa o construtor (implícito ou explícito); 
Retorna a referência para p. Ou seja: Mesmo sem construtor definido, o this já está lá; Ele sempre aponta para o mesmo objeto que você está manipulando.

```php
<?ph
    $p = new Pessoa();
p?>
```
O PHP faz o seguinte internamente:

Cria um novo objeto Pessoa em memória;

Associa $this a esse novo objeto;

Executa o construtor (implícito ou explícito);

Retorna a referência do objeto para $p.

Ou seja:

Mesmo sem construtor declarado, o $this já existe;

Ele sempre aponta para o mesmo objeto que está sendo manipulado.

### $this-> (SEM CONSTRUTOR)

```php
<?
class Pessoa {
    public $nome;
    public $idade;

    public function definir($nome, $idade) {
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function mostrar() {
        echo $this->nome . " - " . $this->idade;
    }
}

$p = new Pessoa(); // construtor implícito
$p->definir("Carlos", 25);
$p->mostrar();

// SAIDA: Carlos - 25
?>
```

🔍 Explicando:

Mesmo sem um construtor explícito, o PHP cria o objeto Pessoa em memória.

O $this já existe dentro de qualquer método.

Dentro de definir() e mostrar(), $this aponta para o mesmo objeto $p.

$this->nome e $this->idade se referem às propriedades daquela instância específica.

### $this-> (COM CONSTRUTOR)

```php
<?php
class Pessoa {
    public $nome;
    public $idade;

    public function __construct($nome, $idade) {
        $this->nome = $nome;   // mesmo efeito do método definir()
        $this->idade = $idade;
    }

    public function mostrar() {
        echo $this->nome . " - " . $this->idade;
    }
}

$p = new Pessoa("Carlos", 25);
$p->mostrar();
?>
```

O que mudou:

O $this continua sendo o mesmo conceito — o objeto atual.

A única diferença é onde ocorre a atribuição:
agora os valores são definidos durante a criação, dentro do __construct().

Assim, o objeto já nasce completamente configurado

## 5. Onde está o dinamismo do $this?

➡️ O $this não é fixo.
Ele é resolvido em tempo de execução conforme qual objeto está ativo no momento da execução.

```php
<?php
$p1 = new Pessoa("Ana", 20);
$p2 = new Pessoa("Beatriz", 30);
?>
```

Durante a execução:

Quando $p1 é criado, dentro de __construct(), o $this aponta para o objeto $p1;

Quando $p2 é criado, dentro do mesmo método __construct(), o $this aponta para $p2.

🧠 Mesmo código-fonte, mas $this muda conforme o objeto que está em contexto.
Esse é o dinamismo — $this acompanha a instância que está executando o método.

O mesmo ocorre sem construtor.Mesmo sem um construtor explícito, o $this continua se comportando dinamicamente.

```php
<?php
class Pessoa {
    public $nome;
    public $idade;

    public function definir($nome, $idade) {
        $this->nome = $nome;
        $this->idade = $idade;
    }
}

$p1 = new Pessoa();
$p2 = new Pessoa();

$p1->definir("Ana", 20);
$p2->definir("Beatriz", 30);
?>
```

➡️ Dentro de definir():

Quando $p1->definir() é chamado, $this aponta para $p1;

Quando $p2->definir() é chamado, $this aponta para $p2.

🧩 Mesmo método, mas o $this muda de referência dinamicamente conforme o objeto que invoca o método.

### 🎯 Resumo da ideia central

| Situação                      | `$this` aponta para...        | Existe construtor explícito? | Observação                                     |
| ----------------------------- | ----------------------------- | ---------------------------- | ---------------------------------------------- |
| Sem construtor declarado      | O objeto que foi criado       | ❌                            | O construtor padrão é implícito                |
| Com construtor explícito      | O mesmo objeto recém-criado   | ✅                            | Atribuições ocorrem dentro do `__construct()`  |
| Chamando métodos de instância | O objeto que invocou o método | —                            | `$this` muda dinamicamente conforme o chamador |

💬 Em resumo

O $this sempre existe em toda instância de classe (mesmo sem __construct() declarado).

Ele aponta dinamicamente para o objeto que está sendo manipulado no momento.

A diferença está apenas onde e quando você usa o $this:

Com construtor: atribui valores durante a criação do objeto.

Sem construtor: atribui valores posteriormente, via métodos comuns.
