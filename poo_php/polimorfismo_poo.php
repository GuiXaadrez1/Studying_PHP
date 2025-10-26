<?php

// ativando tipagem explícita
declare(strict_types=1);

// importando e acessando classe, atributos e métodos de outros arquivo
require_once 'metodo_constructor.php';

    // realizando herança de uma classe concreta  usando extends
    //SuperSaiyajin é uma classe filha de Saiyajin
    class SuperSaiyajin extends Saiyajin{

        // definindo atributos protégidos acessível internamente e por herança
        protected $emocion;
        protected $explosion_ki;

        // criando método construtor
        public function __construct(?string $nombre, ?int $nível_palea,string $emocao, bool $rajada_ki)
        {      
            // Chama o construtor da classe Pessoa (a superclasse)
            // pois criei um próprio construtor da classe filha
            // isso garante que os atributos herdados sejam inicializados corretamente
            parent::__construct($nombre, $nível_palea);

            # instanciando nosso atributos

            $this -> emocion = $emocao;
            $this -> explosion_ki = $rajada_ki;
        }

        // definido método publico
        public function tranfoming():void
        {   
            // usando parent para acessar um método da class pai
            if(parent::aumentarElNivelPalea(20) > $this->nivel_pelea*10){

                echo "O ". $this->nombre. " Está se transformando em SuperSaiyajin ";
                echo "<br>";
                echo parent::aumentarElNivelPalea(20);
                echo "<br>";
                echo "La emoción di ".$this->nombre.' e: '.$this->emocion;
                
                if($this->emocion == 'raiva' && $this->explosion_ki == true){
                    echo "<br>";
                    echo 'Muitas rajadas de ki foram disparadas!'; 
                };
            }else{
                echo "Nível de poder insuficiente para tranformação";
                echo "Atual nível de poder: ".$this->nivel_pelea;
            }
        }
    }


    $goku = new SuperSaiyajin('Goku',1500,'raiva',true);

    echo($goku->tranfoming());
?>