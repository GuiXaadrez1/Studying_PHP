# Abastração 

Agoara vamos aprender um pouco sobre abstração, classes abastratas e polimorfismo de classes, eu constumo dizer que classes abastratas são um class de classes, ou, uma model  para classes (para quem tem familiaridade com programação DJANGO e Laravel vai entender).

## Definição Conceitual

Uma classe abstrata é uma classe incompleta, que não pode ser instanciada diretamente.
Ela é utilizada para definir propriedades e métodos comuns às subclasses, podendo conter tanto métodos concretos (implementados) quanto métodos abstratos (sem implementação).

Os métodos abstratos devem obrigatoriamente ser implementados pelas classes que herdam da classe abstrata, garantindo consistência no comportamento entre diferentes implementações.

## Sintaxe Formal

A declaração de uma classe abstrata em PHP é feita utilizando o modificador **"abstract"**:

```php
<?php

// criando classe abastrata
abstract class NomeDaClasseAbstrata {
    
    // definindo Propriedades
    protected string $nome;

    // Construtor opcional
    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    // Método concreto (com implementação)
    public function exibirNome(): void {
        echo "Nome: " . $this->nome;
    }

    // Método abstrato (sem implementação)
    abstract public function calcularSalario(): float;
}
```

### Regras sintáticas

- Uma classe abstrata é declarada com o prefixo abstract.

### Um método abstrato deve:

- Ser declarado apenas dentro de uma classe abstrata.

- Não possuir corpo (somente a assinatura) -> (lembra muito interface).

- Ser reimplementado obrigatoriamente pelas subclasses concretas.

### Classes abstratas podem conter:

- Propriedades (públicas, protegidas ou privadas);

- Métodos concretos e abstratos;

- Construtores e destrutores;

- Métodos estáticos;

- Constantes de classe.

## Exemplo Prático

Suponha o desenvolvimento de um sistema de folha de pagamento em que diferentes tipos de empregados (fixos, horistas, comissionados) possuem formas distintas de cálculo salarial.

### Classe abastrata base
```php
<?php
// criando class abstrada 
abstract class Empregado {

    // definido propriedades
    protected string $nome;

    // criando um construtor, mas é opcional
    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    // Método comum a todos os empregados
    public function getNome(): string {
        return $this->nome;
    }

    // Método abstrato (definido, mas não implementado)
    abstract public function calcularSalario(): float;
}
```

### Subclass concreta1 (Filha da class abstrata criada)

```php

// craindo subclass que extende da class abstrata 
class EmpregadoFixo extends Empregado {
    
    // definindo propriedade
    private float $salarioMensal;

    // craindo método constructor 
    public function __construct(string $nome, float $salarioMensal) {

        // acessando o método constructor e o parâmetro nome da class pai com parent::
        // basicamente chama o construtor da superclasse
        // isso garante que os atributos herdados sejam inicializados corretamente
        parent::__construct($nome);

        // atribuindo o valor do parâmetro a propriedade da classe
        $this->salarioMensal = $salarioMensal;
    }

    // herdando a função abastrata pré-definida na classe pai e fazendo polimorfismo de Sobrescrita (Override), reescrevendo a estrutura do método
    public function calcularSalario(): float {
        return $this->salarioMensal;
    }
}
```

### Subclass concreta2
```php
class EmpregadoHorista extends Empregado {
    
    private float $valorHora;
    private int $horasTrabalhadas;

    public function __construct(string $nome, float $valorHora, int $horasTrabalhadas) {
        parent::__construct($nome);
        $this->valorHora = $valorHora;
        $this->horasTrabalhadas = $horasTrabalhadas;
    }

    public function calcularSalario(): float {
        return $this->valorHora * $this->horasTrabalhadas;
    }
}
```

### Utilização

```php
<?php

// materializando os objetos das nossas classes
$empregado1 = new EmpregadoFixo("João", 3000);
$empregado2 = new EmpregadoHorista("Maria", 50, 160);

// acessando métodos herdados da class abastrada Empregado getNome() e calcularSalario()
echo $empregado1->getNome() . " recebe R$" . $empregado1->calcularSalario() . PHP_EOL;
echo $empregado2->getNome() . " recebe R$" . $empregado2->calcularSalario() . PHP_EOL;
```

## Fundamentação Teórica

Em termos conceituais, uma classe abstrata representa uma abstração de alto nível que não descreve um objeto concreto, mas sim um conceito genérico.

Matematicamente, pode-se dizer que ela define um tipo parcial, cujo comportamento é apenas parcialmente especificado, sendo completado por subclasses derivadas.

Em engenharia de software, o uso de classes abstratas:

- Reduz a duplicação de código;

- Impõe uma estrutura de contrato para subclasses;

- Facilita a manutenção e a extensibilidade;

- Promove a coerência entre implementações.

## Diferenças entre Classe Abstrata e Interface

| Aspecto       | Classe Abstrata                                          | Interface                                                              |
| ------------- | -------------------------------------------------------- | ---------------------------------------------------------------------- |
| Implementação | Pode conter métodos com implementação                    | Não pode conter implementação (até PHP 7.4)                            |
| Herança       | Suporta **herança única**                                | Suporta **múltiplas implementações**                                   |
| Atributos     | Pode conter propriedades                                 | Pode conter constantes (e a partir do PHP 8.1, propriedades estáticas) |
| Uso principal | Compartilhar código comum e exigir implementação parcial | Definir **contratos de comportamento** puros                           |

## Polimorfismo em Classes Abstratas

Classes abstratas permitem polimorfismo, ou seja, o uso de um mesmo método com comportamentos diferentes em subclasses.

```php
function exibirSalario(Empregado $empregado): void {
    echo $empregado->getNome() . ": R$" . $empregado->calcularSalario() . PHP_EOL;
}

exibirSalario(new EmpregadoFixo("Ana", 4000));
exibirSalario(new EmpregadoHorista("Carlos", 40, 150));
```

Nesse caso, o método calcularSalario() é invocado polimorficamente, pois o mesmo nome de método produz resultados distintos dependendo da subclasse concreta.

## Aplicações Reais

Classes abstratas são amplamente utilizadas em frameworks PHP modernos, como:

Laravel:

- Controladores base (Controller) são abstratos.

Symfony:

- Componentes como AbstractController e AbstractCommand impõem contratos de comportamento.

Doctrine ORM:

- Define entidades abstratas para mapeamento de modelos.

Esses frameworks aplicam o conceito para forçar os desenvolvedores a seguir um padrão arquitetural coerente, garantindo manutenibilidade e escalabilidade

## Conclusão

O uso de classes abstratas em PHP é uma prática essencial na modelagem de sistemas orientados a objetos.

Elas permitem definir modelos conceituais, estabelecer contratos parciais e promover o reuso e a padronização do código.

Em termos de engenharia de software, constituem um mecanismo intermediário entre a abstração teórica e a implementação concreta, sustentando os princípios de herança e polimorfismo fundamentais à POO.

## Referências

PHP Documentation — Abstract Classes and Methods
https://www.php.net/manual/en/language.oop5.abstract.php

Larman, C. Applying UML and Patterns: An Introduction to Object-Oriented Analysis and Design and Iterative Development. Prentice Hall, 2004.

Fowler, M. UML Distilled: A Brief Guide to the Standard Object Modeling Language. Addison-Wesley, 2003.

Gamma, E. et al. Design Patterns: Elements of Reusable Object-Oriented Software. Addison-Wesley, 1994.
