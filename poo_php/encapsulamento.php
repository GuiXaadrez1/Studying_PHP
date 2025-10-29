<?php

    // Criando uma classe com atributos e métodos de nível de encapsulamento publico


    // Criando uma classe com atributos e métodos de nível de encapsulamento protegido


    // Criando uma classe com atributos e métodos de nível de encapsulamento privado
    // com métodos getters e setters


    // Criando uma class com nível de encapsulamento misturado nos atributos e métodos

    class SerHumano{
        public $cor_olhos;
        protected $orgaos;
        private $dna = null;
        
        public function __construct(string $cor_olhos, string $orgao, ?string $dna)
        {
            $this->cor_olhos = $cor_olhos;
            $this->cor_olhos = $orgao;
            $this->cor_olhos = $dna;
        }
    
        public function exbirCorOlhos(){
            return $this->cor_olhos;
        } 

        protected function exibirOrgaos(){
            return $this->orgaos;
        }
        
        public function getExibirDna(){
            return $this->dna;
        }
        
        public function setDestruirDna(){
            return $this->dna = null;
        }
    }

?>