<?php

// criando a classe Pessoa
class Pessoa{

    //  Lembrando que a versão do PHP 8 permite definir o tipo de dado dos atributos
    // versão do PHP 7 e anteriores não permite definir o tipo de dado dos atributos

    
    // definindo atributos/propriedades públicos
    public string $nome_pessoa;
    public int $idade_pessoa;

    // criando o método construtor
    public function __construct($nome,$idade){
        $this -> nome_pessoa = $nome;
        $this -> idade_pessoa = $idade;
    }

    // criando um método píblico para a classe Pessoa
    public function falar(string $text = "Olá, meu nome é "): string
    {
        return $text . $this->nome_pessoa . " e tenho " . $this->idade_pessoa . " anos.";
    }

}

// nomeando parâmetros do método na instância do objeto
$objectPessoa = new Pessoa(nome:"Carlos",idade:25);

// exibindo o resultado do método falar sem parâmetros
echo $objectPessoa -> falar();

// exibindo o resultado do método falar com parâmetros
echo "<br>";    

echo $objectPessoa -> falar("Oi meu nome é ");
?>