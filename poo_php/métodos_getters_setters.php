<?php
    
    class ContaBancaria{

        // lembrando que somente essa classe tem acesso direto
        // as propriedades com nível de encapsulamento private
        // eles só são acessados e módificados, editados com os métodos
        // especíais getters e setters

        private $numero_banco;
        private $numero_agencia;
        private $numero_conta;
        private $saldo_conta;
        public $tipo_conta;


        public function __construct(int $num_banco, int $num_agencia, $num_conta, float $saldo = 0, string $tp_conta)
        {   
            $this-> numero_banco = $num_banco;
            $this-> numero_agencia  = $num_agencia;
            $this-> numero_conta = $num_conta; 
            $this-> saldo_conta = $saldo;
            $this-> tipo_conta = $tp_conta;
        }

        // definido métodos Getter e Setters 

        public function getSaldo(){
            return $this->saldo_conta;
        }
        
        public function setDepositarSaldo(float $valor){
            return $this->saldo_conta += $valor;
        }

        public function setDebitarSaldo(float $valor){

            if($valor > $this->saldo_conta){
                return "Não é possível realizar o débito, saldo acima do saldo existente";
            }else{
                return $this->saldo_conta -= $valor;
            }
        }
    }

    $contaBancaria1 = new ContaBancaria(12345,14123,12312,0,'Salário');

    $contaBancaria1->setDepositarSaldo(1500);

    echo("Foi depositado: " .$contaBancaria1->getSaldo());

    echo("<br><br>");

    echo("Foi debitado: " .$contaBancaria1->setDebitarSaldo(500));

    echo("<br><br>");

    echo("Foi debitado: " .$contaBancaria1->setDebitarSaldo(1500));
?>