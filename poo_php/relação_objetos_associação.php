<?php

// Associação 

// Acontece quando um objeto "utiliza" outro, porém, sem que eles dependam um do outro
// isso é diferente de composição que é IoC - inversao de controle.

// Craindo class Pedido

class Pedido{

    // definindo os atributos
    
    protected $clientePedido;
    protected $numeroPedido;

    public function __construct($numero,$cliente){

        $this->numeroPedido = $numero;
        $this->clientePedido = $cliente;
        
    }

    // Getters
    public function getInfoPedido():array{
        return [
            "numero pedido" => $this->numeroPedido,
            "cliente" => $this->clientePedido,
        ];
    }

}

// Criando class Cliente
class Cliente{

    protected $nome;
    protected $email;
    
    public function __construct($nome,$email){

        try{
            
            $this->nome = $nome;

            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $this->email = $email;
            }else{
                die("Email no formato inválido!");
            };
        }catch(Exception $e){
            die("Falha do sistema: ".$e);
        };
    }

    // Getters
    
    public function getInfoClient():array{
        
        return [
            "nomeCliente" => $this->nome,
            "emailCliente" => $this->email,
        ];
    
    }

}

// Materializando os nossos objetos criados e Realizando as Associações entre eles.

$client = new Cliente("Guilherme Henrique","guilherme@12gmail.com");

// passando o objeto cliente para o objeto pedido, em teoria isso aqui é composicao
$pedido = new Pedido(1234,$client);

// fazendo associacao

// veja que estou acessando propriedades espeíficas do objeto pedido e
// estou acessando propriedades específicas do objeto cliente através da propriedade
// clientePedido do objeto Pedido.

$dados = [
    "pedido" => $pedido->getInfoPedido()["numero pedido"],
    "cliente" => $pedido->getInfoPedido()["cliente"]->getInfoClient(),
];

echo "<pre>";
var_dump($dados);
echo "<pre>";