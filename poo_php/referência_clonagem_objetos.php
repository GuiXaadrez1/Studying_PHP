<?php

// declarando tipagem explícita!
declare(strict_types=1);

// Criando uma interface para amamentar

interface acao_mamímefo{
    public function amamentar(?bool $filhote):string;
}

// criando classe Mamífero

class Mamímefo implements acao_mamímefo{

    // propriedades caracteríticas de um mamífero
    protected bool $teta; 
    protected bool $pelos; 
    protected bool $vertebrado;
    public bool|null $boca;

    // método construtor
    public function __construct(bool $teta, bool $pelos, bool $vertebrado, ?bool $boca){
        $this->teta = $teta;
        $this->pelos = $pelos;
        $this->vertebrado = $vertebrado;
        $this->boca = $boca;
    }

    // utilizando a inteface para realizar polimorfismo de sobrescrita
    public function amamentar(?bool $filhote):string{
        if($filhote===true){
            return 'Amamentando o seu filhote';
        }else{
            return 'Apenas filhotes podem ser amamentados';
        };
    }

}

// criando uma class que herda as proprieades de mamífero
class Gato extends Mamímefo{

    // por convenção do Java eu sempre crio construtor na class filha 
    // para mais segurança
    public function __construct(bool $teta, bool $pelos, bool $vertebrado, ?bool $boca){
        // puxandos as propriedades da classe pai para filha
        parent::__construct($teta, $pelos, $vertebrado, $boca);
    }
}


// instânciando um obeto gato que
$objetoGato = new Gato(true,true,true,true);

//echo($objetoGato->amamentar(true));

echo($objetoGato->boca);

// Saida:true


// Agora vamos trabalha com o conceito de Referência e Clonagem de POO php

$objetoGato2 = new Gato(false,true,true,false);

echo('<br><br>'.$objetoGato2->boca.'<br><br>');

var_dump($objetoGato2->boca);

// Saida: false

/* 
    Veja que temos dois objetos diferentes instânciados
    Mas o PHP é tão maluco que podemos fazer uma clonagem
    do primeiro objeto de gato, atribuir e referênciar ele
    no objeto gato dois 

    com a palavra chave: clone
*/

$objetoGato2 = clone $objetoGato;

var_dump($objetoGato2->boca);

//var_dump($objetoGato2->boca);

//Saida: true
?>