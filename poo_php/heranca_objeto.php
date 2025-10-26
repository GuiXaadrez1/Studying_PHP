<?php

    // puxando a classe Pessoa de outro arquivo
    // lembrando que não é necessário usar o require_once se a classe Pessoa estiver 
    // no mesmo diretório deste arquivo
    // fiz isso apenas para exemplificar o uso do require_once

    require_once 'named_parameters_pessoa.php';

    // criando a classe Aluno que herda da classe Pessoa
    // extebnds é a palavra chave usada para herança em PHP
    class Aluno extends Pessoa {


        // definindo atributos privados que so podem ser acessados por essa class
        private string $matricula; 
        private string $curso;
        private float $nota_aluno; 
    
    // ✅ Construtor que chama o da classe pai
    public function __construct(string $nome, int $idade, string $matricula = "", string $curso = "", float $nota = 0.0)
    {
        // Chama o construtor da classe Pessoa (a superclasse)
        // pois criei um próprio construtor da classe filha
        // isso garante que os atributos herdados sejam inicializados corretamente
        parent::__construct($nome, $idade);

        $this->matricula = $matricula;
        $this->curso = $curso;
        $this->nota_aluno = $nota;
    }
        
        public function avaliarAluno(float $nota): string
        {
            $this -> nota_aluno = $nota;

            if($this -> nota_aluno >= 7){
                return "Aluno aprovado com a nota: " . $this -> nota_aluno;
            } else {
                return "Aluno reprovado com a nota: " . $this -> nota_aluno;
            }
        }

        // metodos getters e setters



    }

    // ✅ Criação do objeto corretamente
    $aluno1 = new Aluno(nome:"Guilherme",idade: 20,matricula: "2025A001", curso:"ADS");

    echo "<br>";

    // ✅ Usando método herdado da classe Pessoa
    echo $aluno1->falar();

    echo "<br>";

    // ✅ Usando método próprio da classe Aluno
    echo $aluno1->avaliarAluno(8.5);
?>