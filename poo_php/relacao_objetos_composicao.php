<?php

    // Agor avamos aprender sobre compisicao

    // Basicamente vamos intanciar uma class dentro de outra class
    // podemos fazer inversao de controller usando composicao ou injecao de depedencia
    // basicamente instanciando uma class no metodo construtor de outra

    // Resumindo:
    // Basicamente composicao, uma classe cria a instância de outra class dentro de si própria
    // ou no seu construtor, sendo assim, quando ela for destruída, a outra classe também será.

    // Criando class Pessoa pra exemplo
    class Pessoa{

        # definindo atributo da class 
        protected $name;

        # criando construtor
        function __construct(string $nome){
            $this->name = $nome;
        }

        public function getNomePessoa(){
            return $this->name;
        }

        public function falarNome(){
            echo "Meu nome é: ".$this->getNomePessoa();
        }

    }

    // instanciando a class Pessoa

    $pessoa1 = new Pessoa("Guilherme Henrique Almeida da Silva");

    // $pessoa1->falarNome();

    class Emprego{
        
        // Definindo Propriedades 

        // definindo a instância da class Pessoa para composicao
        private Pessoa $pessoa;

        // tipagem, type hit em atributos só funcionam na versao 8 do php
        protected string $cargo;

        public function __construct($cargo,$pessoa){
            $this->pessoa = $pessoa;
            $this->cargo = $cargo;
        }

        public function exibirCargoPessoa(){
            echo $this->pessoa->falarNome() ."<br>";
            echo "Meu cargo é: ". $this->cargo;
        }

    }

    $emprego = new Emprego("Desenvolvedor Full-Stack",$pessoa1);

    $emprego->exibirCargoPessoa();
?>  