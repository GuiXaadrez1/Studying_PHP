# Classe e Objeto

Em programação orientado a objeto temos dois conceitos que tem uma certa similiaridade, mas seus conceitos são completamente diferentes ao qual chamamos de class e objetos.

## O que são Class? 

Classe: é o conceito, uma forma, é como se fosse uma planta na arquitetura, ou seja
podemos definir que a classe ainda não existe é apenas ideia do que aquilo pode ser

Dentro desta classe temos atributos e métodos que possível seu nível de encapsulamento

### Exemplo:

```php

// ativando tipagem explícita
declare(strict_types=1);

// criando uma classe
class Pet{
    
    // definindo atributos de nível de encapsulamento público, ou seja
    // qualquer outra classe pode ter acesso aos atributos desta

    public $nome_pet;
    public $tipo_pet;
    public $raça_pet

    // criando o construtor
    public function __construct(
        string $nome,
        string $tipo,
        string $raça
    ){
        $this->nome_pet=$nome;
        $this->tipo_pet =$tipo;
        $this->raça_pet=$raça;
    }

    // criando método de nível de encapsulamento público

    public function petSom(string $pet):string{

        if($this->tipo_pet == 'Cachorro'){
            return "Au Au Au";
        }else{
            return "Miaaaau!";
        }
    }
}


```

## O que são objetos?

Objeto: É a materialização de uma classe, é pegar a planta e transformar em uma casa,
prédio, ou seja, concretizar aquela planta.

## Exemplo:

```php
<?php

// materializando, criando um objeto
$pet1 = new Pet('Gato','Cachorro','Pincher');

// acessando o método público
echo $pet1->petSom('Cahorro');
?>
```