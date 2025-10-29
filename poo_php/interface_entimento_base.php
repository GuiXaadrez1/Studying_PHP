<?php

# Craindo uma interface
interface Animal {
    public function fazerSom(): string;
    public function mover(): void;
}

/*

    Criando um class que implementa ma interface, isto é
    garantir um comportamento comum entre classes diferentes, promovendo polimorfismo
    estrutural (todas as classes que implementam a interface podem ser tratadas de forma
    uniforme, mesmo que suas implementações sejam distintas)
*/

class Cachorro implements Animal {
    public function fazerSom(): string {
        return "Au Au!";
    }

    public function mover(): void {
        echo "O cachorro está correndo!";
    }
}

class Gato implements Animal {
    public function fazerSom(): string {
        return "Miau!";
    }

    public function mover(): void {
        echo "O gato está andando silenciosamente...";
    }
}

# criando uma função que rescebe um objeto que implementa a interface animal
function emitirSom(Animal $animal) {
    
    // esse objeto vai acessar o método fazerSom() com a versão sobrescrita
    echo $animal->fazerSom();
}

$cachorro = new Cachorro();
$gato = new Gato();

emitirSom($cachorro);
echo"<br>";
emitirSom($gato);

/* 

    Explicação detalhada do que aconteceu aqui: 

    O Papel da Interface (O Contrato)
        
        Primeiro, imagine que existe uma Interface chamada Animal 
        
        O que é a Interface Animal? É um contrato que define quais métodos (ações) 
        qualquer classe que queira ser considerada um "Animal" deve, obrigatoriamente, 
        implementar.

        No seu caso: Essa interface tem, no mínimo, a assinatura do método fazerSom()

    Obrigatoriedade: As classes Cachorro e Gato implementam esse contrato. 
    Isso significa que elas prometem que cada uma terá sua própria versão do método
    fazerSom().



    A Função emitirSom() (A Flexibilidade)
    
    Tipagem Forte: O segredo está aqui: Animal $animal. Ao invés de aceitar somente um 
    Cachorro ou somente um Gato, a função exige que o parâmetro seja um objeto de qualquer
    classe que implemente a interface Animal.
    
    A "Mágica": A função não precisa saber se está lidando com um cachorro, um gato, 
    uma vaca, ou um pato. Ela só confia que, por contrato, o objeto passado certamente terá o método fazerSom(). Isso torna a função extremamente flexível e reutilizável.

*/
?>