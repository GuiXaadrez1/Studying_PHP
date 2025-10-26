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

        // definindo atributos protegidos
        protected $nombre;
        protected $nivel_pelea;

        // criando um método construtor -> método mágico
        // sempre começa com dois underlines __
        // se os atributos não forem passados, serão atribuídos valores padrão
        function __construct(string $nombre = "Goku", int $nivel_pelea = 1500){
            $this ->nombre = $nombre;
            $this ->nivel_pelea = $nivel_pelea;
        }

        public function saludar(string $text = "Hola soy "): string
        {   
            // concatenadno o texto que passamos como parâmetro com o atributo da classe
            return $text.$this->nombre;
        }

        public function nivelDePelea(int $palea = 0):string{
            return $this->nombre." tiene un nivel de pelea de: ".(string) $palea;
        }

        public function aumentarElNivelPalea(int $agrandar = 20){
            return 'Ampliando poder em: '. $agrandar .' vezes. '. ' O atual poder é de: '. $this->nivel_pelea*$agrandar;
        }

        public function atacar(): void
        {
            echo "Kamehameha!!!";
        }

        public function defender(): void
        {
            echo "Defense! Defense! Defense!";
        }
    }

    // instânciando um objeto da classe Saiyajin

    /*
    $Gohan = new Saiyajin("Gohan",3000);

    // visualizando todos os atributos que existem no objeto $Gohan

    var_dump($Gohan);

    //echo($Gohan->nivelDePelea($Gohan->nivel_pelea));

    // acessando os métods, atributos do objeto com o símbolo "seta" ->

    echo "<br>";
    echo $Gohan->nombre;
    echo "<br>";
    echo $Gohan->nivel_pelea;

    // Agora instanciando um atributo com valor padrão
    echo("<br><br>");
    $goku = new Saiyajin();

    // visualizando todos os atributos que existem no objeto $goku
    var_dump($goku); 
    echo "<br>";
    echo $goku->nombre;
    echo "<br>";
    echo $goku->nivel_pelea;

    // mudando o nível de poder do Goku
    $goku->nivel_pelea = 5000;
    echo "<br> Nivel de pelea de Goku modificado: " . $goku->nivel_pelea;

    // acessando os métodos do objeto $goku
    echo "<br>";
    echo($goku->saludar("Hola soy "));


    $vegeta = new Saiyajin("Vegeta",4000);
    echo "<br>";

    echo($vegeta->saludar("Hola soy "));
    echo "<br>";

    $gohan = new Saiyajin("Gohan",3000);
    echo($gohan->saludar());

    */
?>  
