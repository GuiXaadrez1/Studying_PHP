<?php

    declare(strict_types=1);

    /**
     * English:
     * The constructor method went created for declare dynamic attributes into class
     * 
     * Remember: the method constructor always be public
     * 
     * Observation: 
     * $this -> acess the attributes and methods of the class 
     * because this is a reference to the current object 
     * and yet existes the method constructor and $this-> even though 
     * don´t declere the method  but so only exist implicitly to the declarar the object the class 
     * and call methods publics and attributes whith $this->
     * It is also possible to create default value attributes within the class.
     * into method constructor
     * 
     * Portuguese:
     * O método construtor foi criado para declarar atributos dinâmicos na classe
     * 
     * Lembre-se: 
     * o método construtor sempre será público
     * 
     * Observação:
     ** $this -> acessa os atributos e métodos da classe 
     * porque esta é uma referência ao objeto atual 
     * e ainda existe o construtor do método e $this-> embora 
     * não declere o método, mas apenas existe implicitamente
     * ao declarar um objeto da class e chamar os atributos e metodos
     * também é possível criar atributos de valor padrão dentro da class
     * dentro do método construtor
    
     *@param string $nombre
     *@param int $nivel_palea
     */
    class Saiyajin
    {   
        // criando um método construtor -> método mágico
    
        function __construct(string $nombre = "Goku", int $nivel_pelea = 1500){
            $this ->nombre = $nombre;
            $this ->nivel_pelea = $nivel_pelea;
        }

        public function nivelDePelea(int $palea = 0):string{
            return $this->nombre." tiene un nivel de pelea de: ".(string) $palea;
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

    $Gohan = new Saiyajin("Gohan",3000);

?>
