<?php

    declare(strict_types=1);

    /**
     * English:
     * The constructor method went created for declare dynamic attributes into class
     * 
     * Remember: the method constructor always be public
     * 
     * Observation: $this -> acess the attributes and methods of the class 
     * because this is a reference to the current object 
     * 
     * 
     * 
     * Portuguese:
     * O método construtor foi criado para declarar atributos dinâmicos na classe
     * lembre-se: o método construtor sempre será público
     * 
     *@param string $nombre
     *@param int $nivel_palea
     */
    class Saiyajin
    {   
        // criando um método construtor -> método mágico
        
        function __construct(string $nombre, int $nivel_pelea){
            $this ->nombre = $nombre;
            $this ->nivel_pelea = $nivel_pelea;
        }

        public function tranfoming():void
        {
            echo "Se transforma en Super Saiyajin!!!";
        }

        public function atacar(): void
        {
            echo "Kamehameha!!!";
        }


        public function defender(): void
        {
            echo "Haaaaaaa!!!";
        }
    }


    $Gohan = new Saiyajin("Gohan", 1500);

?>
