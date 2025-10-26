# Herança no contexto de programação orientado a Objeto

Assim como no mundo real, a palavra herança se refere ao conceito de receber algo, herdar algo de alguém. Herança aqui pode ser entendida como um mecanismo que permite construir uma nova classe com base em uma classe previamente existente, em que a nova herda automaticamente todos os atributos, comportamentos e implementações da classe-pai.

Em se tratando de herança, estamos falando de um dos maiores benefícios da Orientação a 
Objetos, além da capacidade de encapsulamento. Com a herança podemos reutilizar partes 
de código já definidos, além da agilidade, ela elimina a necessidade de duplicar ou 
rescrever certo código.

Herança é um conceito de programação estabelecido, e o PHP faz uso deste em seu modelo 
de objetos. Este princípio afeta a forma com que classes e objetos se relacionam com 
outras.

Por exemplo, ao estender uma classe, a subclasse herda todos os métodos públicos e 
protegidos, propriedades e constantes da super classe. A não ser que uma classe 
sobrescreva estes métodos, eles manterão sua funcionalidade original.

Os métodos privados de uma super classe (classe pai) não são acessíveis a uma subclass 
(classes derivadas ou classes filhas). Como resultado, as classes filhas podem 
reimplementar um método privado sem levar em conta as regras normais de herança. 

Antes do PHP 8.0.0, entretanto, as restrições final e static eram aplicadas aos métodos 
privados. 

Desde o PHP 8.0.0, a única restrição de método privado que é aplicada é private final 
para construtores, já que essa é uma maneira comum de "desabilitar" o construtor ao usar 
métodos de fábrica estáticos.

Para acessar os métodos sobrescritos ou membros estáticos da classe pai, utilizamos a palavra reservada parent. É importante destacar que somente os métodos protect e public podem ser reescritos.

## Super classe (classe pai/mãe/base)

Superclasses são classes mãe, que não derivam de nenhuma outra classe.
É a classe geral, que contém propriedades e métodos comuns a um grupo de objetos.
Ela representa um conceito mais abstrato dentro do domínio do sistema.

### Exemplo:
```php
<?php
    class Pessoa{

        // criando propriedades protegidas 
        protected $nome_pessoa;
        protected  $idade_pessoa;    

        // criando construtor
        public function __construct(string $nome, int $idade){
            $this->nome_pessoa = $nome;
            $this->idade_pessoa = $idade;
        }

        // criando um método protegido 
        protected function falar(string $text = "Olá, meu nome é "):strig{
            return $text . $this->nome_pessoa . " e tenho " . $this->idade_pessoa . " anos.";
        }

    }
?>
```
Perceba também, que ambas os elementos dentro da minha classe (propriedades e métodos) são "protected", ou seja, não podem ser acessados diretamente pelo programa, somente pela superclasse e suas subclasses.


## Subclasse (classes derivadas ou filhas)
É a classe específica que herda da superclasse e pode:

- Reutilizar seus atributos e métodos.

- Adicionar novos atributos e comportamentos.

- Sobrescrever métodos da classe base (polimorfismo).

# Exemplo:

```php
<?php
require_once 'Pessoa.php';


// a palavra chave extends é usada para fazer a herança da pai para a filha
// lembrando que isso só funciona para classes concretas e não interfaces
// para interfaces, utiliza-se "implements"

class Aluno extends Pessoa {
    public string $curso;
    public float $nota;

    public function estudar(): string {
        return "{$this->nome} está estudando para o curso de {$this->curso}.";
    }
}

?>
```

Aqui, Aluno é uma subclasse que herda nome, idade e falar() da classe Pessoa, e adiciona curso, nota e o método estudar().


## O USO DE parent em herança!
A palavra-chave parent tem duas finalidades principais:

### 1 - Chamar o construtor da classe pai

→ Quando a subclasse define seu próprio construtor, é necessário chamar o construtor da classe base explicitamente.

```php
parent::__construct($nome, $idade);
```
Isso garante que os atributos herdados sejam inicializados corretamente

### 2 - Acessar métodos da classe pai que foram sobrescritos

→ Caso uma subclasse reescreva um método herdado, ainda é possível acessar a versão original dele:

```php
<?php
public function apresentar(): string {
    return parent::apresentar() . " Além disso, sou professor.";
}
?>
```

Aqui, parent::apresentar() chama a versão original do método da classe Pessoa.


## O OPERADOR DE RESOLUÇÃO DE ESCOPO ::

O operador :: (chamado Scope Resolution Operator) é usado para acessar membros estáticos, constantes ou métodos da classe pai.

Exemplos de uso:

| Sintaxe                    | Descrição                                                                             |
| -------------------------- | ------------------------------------------------------------------------------------- |
| `Classe::constante`        | Acessa uma constante da classe                                                        |
| `Classe::metodoEstatico()` | Chama um método estático                                                              |
| `parent::metodo()`         | Chama um método da superclasse                                                        |
| `self::metodo()`           | Chama um método estático da própria classe                                            |
| `static::metodo()`         | Chama um método estático respeitando o contexto da classe filha (late static binding) |

### Exemplo:

```php
<?php
    class Sistema {
        public static function versao(): string {
            return "Versão 1.0";
        }
    }

    echo Sistema::versao(); // saída: Versão 1.0
?>
```

## DIFERENÇA ENTRE extends E implements

| Palavra-chave | Função                                            | Relação            | Quantidade permitida                          |
| ------------- | ------------------------------------------------- | ------------------ | --------------------------------------------- |
| `extends`     | Herda atributos e métodos de uma **classe base**  | Classe → Classe    | Somente **uma** superclasse                   |
| `implements`  | Implementa **métodos definidos em uma interface** | Classe → Interface | **Várias interfaces** podem ser implementadas |


### Exemplo com extends:

```php
class Funcionario extends Pessoa {
    public string $cargo;
}
```

➡️ Aqui, Funcionario herda código de Pessoa.

### Exemplo com implements:

```php
interface Autenticavel {
    public function autenticar(string $usuario, string $senha): bool;
}

class SistemaLogin implements Autenticavel {
    public function autenticar(string $usuario, string $senha): bool {
        return $usuario === "admin" && $senha === "1234";
    }
}
```

➡️ SistemaLogin não herda código, mas é obrigado a implementar os métodos da interface.


## SOBRESCRITA (OVERRIDING) DE MÉTODOS

A subclasse pode redefinir métodos herdados da superclasse para alterar o comportamento.

```php
class Pessoa {
    public function falar(): string {
        return "Olá, eu sou uma pessoa.";
    }
}

class Aluno extends Pessoa {
    public function falar(): string {
        return "Olá, eu sou um aluno.";
    }
}
```

➡️ Se falar() for chamado a partir de um objeto Aluno, a versão da subclasse será usada.

## PROTEÇÃO DE ATRIBUTOS (ENCAPSULAMENTO NA HERANÇA)

Em herança, o modificador de acesso define o nível de visibilidade dos atributos e métodos herdados:

| Modificador | Acesso dentro da classe | Acesso nas subclasses | Acesso externo |
| ----------- | ----------------------- | --------------------- | -------------- |
| `private`   | ✅                       | ❌                     | ❌              |
| `protected` | ✅                       | ✅                     | ❌              |
| `public`    | ✅                       | ✅                     | ✅              |

Recomenda-se o uso de protected em atributos da superclasse, pois eles devem ser herdados, mas não expostos externamente.

## Exemplo prático:

```php
class Pessoa {
    protected string $nome;

    public function __construct(string $nome) {
        $this->nome = $nome;
    }
}

class Aluno extends Pessoa {
    public function apresentar(): string {
        // Pode acessar $nome porque é protected
        return "Sou o aluno {$this->nome}.";
    }
}
```

## Referências:

documentação: https://www.php.net/manual/pt_BR/language.oop5.inheritance.php
artigo: https://www.gigasystems.com.br/artigo/62/heranca-e-polimorfismo-em-php
