<?php
class Pet{
    
    // definindo atributos de nível de encapsulamento público, ou seja
    // qualquer outra classe pode ter acesso aos atributos desta

    public $nome_pet;
    public $tipo_pet;
    public $raça_pet;

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

$pet1 = new Pet('Gato','Cachorro','Pincher');

echo $pet1->petSom('Cahorro');

?>