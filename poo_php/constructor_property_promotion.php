<?php

    // a versão do php 8.0 trouxe uma nova funcionalidade chamada constructor property promotion
    // ela permite que você defina e inicialize propriedades de classe diretamente no construtor
    // isso reduz a quantidade de código boilerplate necessário para criar classes com propriedades
    
    class Empresa{

        public function __construct(
            public string $nome_empresa,
            public int $cnpj,
            public string $endereco
        ){}
        
        // note que não precisamos mais declarar as propriedades separadamente
        // nem inicializá-las dentro do construtor
        
        public function exibirDetalhes(): string {    
            return "Empresa: {$this->nome_empresa}; CNPJ: {$this->cnpj}; Endereço: {$this->endereco}";
        }
    }

    // materializando um objeto da class
    $empresaObject = new Empresa("Tech Solutions", 12345678000199, "Av. Inovação, 1000");
    
    // exibindo os detalhes da empresa
    $showInformation = explode(';',$empresaObject->exibirDetalhes());

    // usando um loop para exibir cada informação em uma nova linha
    foreach($showInformation as $info){
        echo '<br>'.$info;
    }
?>
