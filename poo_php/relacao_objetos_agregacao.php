<?php

    // Agregação

    // Na agregação, uma classe precisa da outra para executar sua ação (funcao/metodo), 
    // ou seja, uma classe utiliza a outra na própria instância.


    // Criando class Produtos
    class Product {
        
        protected $name;
        protected $value;

        function __construct(string $nome, float $valor){
            $this->name = $nome;
            $this->value = $valor;
        }

        public function getInfoProduct(): array 
        {
            // Verificamos se as propriedades foram inicializadas e não são nulas
                if (isset($this->name) && isset($this->value)) {
                    return [
                        "nome_produto"  => $this->name,
                        "valor_produto" => $this->value,
                    ];
            }

            // Retorna um array vazio caso os dados não existam, 
            // mantendo a consistência do tipo de retorno.
            return [];
        }

    }

    // class ao qual vamos aplicar a agregação
    class Carrinho {

        protected $product;

        // aplicando o conceito de agregacao, usando uma class para realizar uma ação
        // ao qual dentro de poo, acao é o mesmo que metodo ou funcao
        public function adiciona(Product $produtos){
            $this->product[] = $produtos;
        }

        public function exibirProdutos(){

            $produtosCarrinho = [];

            foreach($this->product as $produto){
                $produtosCarrinho[] = $produto->getInfoProduct();
            }

            return $produtosCarrinho;

        }

    } 


    // Agora vamos exibir na telaz como funciona esse código


    // Criando lista de produtos
    $listProduct = [

        $product1 = new Product("Notbook Sangung Book",1700.00),
        $procuct2 = new Product("Iphone Apple 12",3700.00),
        $product3 = new Product("Head Phone AK-47",2700.00),

    ];

    // Criando o carrinho  e adicionando o produto no carrinho...
    // aqui iremos aplicar a agregação do entre os objetos
    $carrinho = new Carrinho();

    // Para cada Produto, vamos adiciona-los no carrinho
    foreach ( $listProduct as $products ) {
        /*echo "<pre>";
        var_dump($products->getInfoProduct());
        echo "<pre>";*/

        $carrinho->adiciona($products);
    }

    // Exibindo os produtos que estão no carrinho
    foreach($carrinho->exibirProdutos() as $ProductsCarrinho){
        /*echo "<pre>";
        var_dump($ProductsCarrinho);
        echo "<pre>";*/
    
        echo "Produto: ".$ProductsCarrinho['nome_produto']." - Preço: R$ ".number_format($ProductsCarrinho['valor_produto'],2,',','.')."<br>";
    }
    
?>