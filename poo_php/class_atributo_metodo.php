<?php

    //  Que es y cómo definir una clase, método y atributo [ejemplo]

    // definido tipagem explícita no php
    // define tipagem explícita no PHP (modo estrito)
    declare(strict_types=1);

    // não confudir com define()

    // define() é uma função para declarar constantes globais
    // const é usado para constantes dentro da classe   

    // definindo uma class em PHP
    class Saiyajin
    {
        // definindo atributos (propriedades) com tipagem 
        // só é válido para versões do php acima do 7.3.x
        // 7.2.x não tem suporte

        /*        
        
        public string $nombre = 'Goku';      // valor padrão
        public int $nivel_pelea = 1000;
        
        */
        

        public $nombre = 'Goku';      // valor padrão
        public $nivel_pelea = 1000;

        // criando métodos ou funções

        /**
         * This function get a parameter and and return an phrase
         * Esta função obtém um parâmetro e retorna uma frase
         * @param string $texto parâmetro que rescebe um texto
         * @return string retorna um saudação 
        */
        
        // coloquei um valor padrão, default no parâmetro
        public function saludar(string $text ="Goku"): string
        {
            // concatenando uma string com o atributo da classe
            return "Hola soy " . $text;
    
            // $this-> serve para acessar atributos ou métodos
            // da instância atual da classe
        }


        /**
         * The function get a parameter type int and return in string the level power the Saiyajin
         * A função recebe um parâmetro do tipo int e retorna em string o nível de potência do Saiyajin
         *@param int $pelea
         * @return string
         */ 
        public function nivelDePelea(int $palea = 0):string{
            return $this->nombre." tiene un nivel de pelea de: ".(string) $palea;
        }

        /** 
        * This class so only exists for to demonstrate concatenation the methods
        * Esta classe só existe para demonstrar a concatenação dos métodos
        * @return string 
        */
        public function concatenarMetodo():string{
            return (string) $this-> saludar($this->nombre) ." e" . " " .$this->nivelDePelea($this->nivel_pelea);
        }

    }

    // instânciando um objeto da classe Saiyajin
    $goku = new Saiyajin();

    // visualizando todos os atributos que existem no objeto $goku
    var_dump($goku);

    // acessando os métods, atributos do objeto com o símbolo ->
    echo($goku->nivel_pelea);
    echo($goku->nombre); 
    echo($goku->saludar($this->nombre)); 
    echo($goku->nivelDePelea($this->nivel_pelea ));
    echo($goku->concatenarMetodo());

    // instânciando outro objeto da classe Saiyajin
    $vegeta = new Saiyajin();

    var_dump($vegeta);

?>