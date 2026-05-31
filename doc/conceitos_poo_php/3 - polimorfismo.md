# POLIMORFISMO NA PROGRAMAÇÃO ORIENTADA A OBJETOS EM PHP

O termo polimorfismo vem do grego:

    "poli" = muitos e "morphos" = formas, ou seja, “muitas formas”.

Na prática, significa que um mesmo método (ou interface) pode assumir comportamentos diferentes dependendo da classe que o implementa.


## Definição 

Polimorfismo é o mecanismo pelo qual um objeto pode se comportar de múltiplas formas, permitindo que uma mesma interface seja utilizada para diferentes tipos de objetos, cada um respondendo à mesma mensagem de maneira específica.

Isso está diretamente relacionado ao conceito de substituição de Liskov, do SOLID, que afirma:

    “Objetos de uma subclasse devem poder substituir objetos de sua superclasse sem alterar o comportamento esperado do programa.”


## Tipos de Polimorfismo

Em linguagens orientadas a objetos, podemos classificar o polimorfismo em dois grandes grupos:

### Polimorfismo de Sobrescrita (Override)

É o tipo mais comum em PHP.

Ocorre quando uma subclasse redefine um método da superclasse, alterando seu comportamento.

É dinâmico, ou seja, é resolvido em tempo de execução.

🔹 Exemplo prático:

```php
<?php

class Pessoa {
    protected string $nome;

    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    public function apresentar(): string {
        return "Olá, meu nome é {$this->nome}.";
    }
}

class Aluno extends Pessoa {
    private string $curso;

    public function __construct(string $nome, string $curso) {
        parent::__construct($nome);
        $this->curso = $curso;
    }

    // Sobrescrita do método da classe pai
    public function apresentar(): string {
        return "Sou aluno do curso de {$this->curso} e meu nome é {$this->nome}.";
    }
}

$pessoa = new Pessoa("Carlos");
$aluno = new Aluno("Carlos", "Sistemas de Informação");

echo $pessoa->apresentar(); // Olá, meu nome é Carlos.
echo "<br>";
echo $aluno->apresentar(); // Sou aluno do curso de Sistemas de Informação e meu nome é Carlos.
?>
```

Análise técnica:

- O método apresentar() foi sobrescrito em Aluno.

- Apesar de ambos terem o mesmo nome e assinatura, o comportamento é diferente.

- O PHP escolhe em tempo de execução qual versão do método chamar — o que caracteriza o polimorfismo dinâmico.

### Polimorfismo de Sobrecarga (Overload)

É quando métodos com o mesmo nome têm parâmetros diferentes (como em Java ou C++).

⚠️ No PHP, não existe sobrecarga nativa de métodos — a linguagem não permite múltiplos métodos com o mesmo nome na mesma classe.

Porém, é possível simular sobrecarga usando:

- Argumentos opcionais;

- Funções com número variável de parâmetros (func_get_args() ou ...$args).

🔹 Exemplo simulando sobrecarga:

```php
<?php

class Calculadora {

    /* Os "..." no parâmetro da função é chamado de Operador Splat
        ou Parâmetro Veriádico (Variadic Parameter)
        Ele permite que a função aceite um número variável de argumentos.
    */

    public function somar(...$numeros): float {
        return array_sum($numeros);
    }

    // Quando usar o Operdaor Splat? 

    /*
        
        Coleção de Argumentos: O PHP (ou a linguagem que suporta) automaticamente coleta todos os argumentos passados para a função nessa posição (e adiante) e os coloca em um array.

        Nome da Variável: O nome $numeros será um array dentro da função, contendo todos os valores que foram passados como argumentos para a função.
    
    */
}

$calc = new Calculadora();
echo $calc->somar(2, 3); // 5
echo "<br>";
echo $calc->somar(1, 2, 3, 4, 5); // 15
?>
```

Aqui o método somar() se adapta dinamicamente ao número de argumentos — uma forma flexível de polimorfismo em PHP.

## Polimorfismo com Interfaces

O polimorfismo também ocorre quando diferentes classes implementam a mesma interface, garantindo que todas forneçam a mesma assinatura de métodos, mas com comportamentos distintos.

Exemplo prático:

```php
<?php

interface Animal {
    public function emitirSom(): string;
}

class Cachorro implements Animal {
    public function emitirSom(): string {
        return "Au Au!";
    }
}

class Gato implements Animal {
    public function emitirSom(): string {
        return "Miau!";
    }
}

function fazerAnimalEmitirSom(Animal $animal) {
    echo $animal->emitirSom() . "<br>";
}

$cachorro = new Cachorro();
$gato = new Gato();

fazerAnimalEmitirSom($cachorro); // Au Au!
fazerAnimalEmitirSom($gato); // Miau!
?>
```

Análise técnica:

- A função fazerAnimalEmitirSom() aceita qualquer objeto que implemente Animal.

- Isso é polimorfismo paramétrico — a função trabalha genericamente com qualquer tipo que respeite o contrato da interface.

- Cada classe responde de forma específica ao mesmo método emitirSom().

## Polimorfismo e o Operador instanceof

O operador instanceof é útil quando se precisa verificar o tipo real de um objeto polimórfico em tempo de execução.

```php
<?php
foreach ([$cachorro, $gato] as $animal) {
    if ($animal instanceof Cachorro) {
        echo "É um cachorro: " . $animal->emitirSom() . "<br>";
    } elseif ($animal instanceof Gato) {
        echo "É um gato: " . $animal->emitirSom() . "<br>";
    }
}
?>
```

## Uso do parent:: no contexto do Polimorfismo

O parent:: permite acessar o método da classe pai dentro de uma sobrescrita, estendendo o comportamento em vez de substituí-lo completamente.

Lembre-se que o O OPERADOR DE RESOLUÇÃO DE ESCOPO "::" = Serve para ara acessar membros estáticos, constantes ou métodos da classe pai.

🔹 Exemplo:

```php
<?php

class Pessoa {
    public function apresentar(): string {
        return "Sou uma pessoa.";
    }
}

class Professor extends Pessoa {
    public function apresentar(): string {
        // Chama o método original e complementa
        return parent::apresentar() . " E também sou professor.";
    }
}

$professor = new Professor();
echo $professor->apresentar();
// Saída: Sou uma pessoa. E também sou professor.
?>
```

## Quando Usar Polimorfismo

Use o polimorfismo quando:

- Desejar trabalhar com objetos diferentes através de uma interface comum.

- Quiser reduzir acoplamento e aumentar a flexibilidade do código.

- Precisar substituir comportamentos sem alterar o código existente.

🔸 Exemplo prático:

Em um sistema de pagamentos, você pode criar múltiplas formas de pagamento (cartão, PIX, boleto) com uma interface comum Pagamento, e o sistema não precisa saber qual classe específica está sendo usada.

## Benefícios

- Extensibilidade: novas classes podem ser adicionadas sem alterar o código existente.

- Flexibilidade: métodos e funções genéricas podem operar sobre tipos diferentes.

- Redução de código duplicado: a lógica geral é mantida, e só o comportamento específico muda.

## Conclusão Científica

O polimorfismo é o mecanismo fundamental de generalização comportamental em linguagens orientadas a objetos. Ele abstrai o comportamento comum, permitindo que instâncias concretas se diferenciem sem quebrar o contrato semântico definido pela hierarquia de classes ou interfaces.

Em PHP, o polimorfismo é implementado principalmente através de:

- Herança e sobrescrita de métodos (extends);

- Implementação de interfaces (implements);

- Uso de parent:: para extensão parcial de comportamento;

- Resolução dinâmica em tempo de execução, refletindo a natureza dinamicamente tipada da linguagem.