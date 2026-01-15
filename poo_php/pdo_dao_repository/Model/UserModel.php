<?php

    // Craindo class Model de Usario para representar a entidade no sistema

    namespace Pdo\Model; 

    class UserModel{

    // Adicione o ? antes de string para permitir nulo
        private ?string $cpf;
        private ?string $name;
        private ?string $email;
        private ?string $tell;

        public function __construct(?string $cpf = "", ?string $name = "", ?string $email = "", ?string $tell = "") {
            $this->cpf = $cpf;
            $this->name = $name;
            $this->email = $email;
            $this->tell = $tell;
        }

        // getters and setters


        // getters obtêm valores das propriedades
        public function getCpf(): string{
            return $this->cpf;
        }

        public function getName(): string{
            return $this->name;
        }

        public function getEmail(): string{
            return $this->email;
        }

        public function getTell(): string{
            return $this->tell;
        }

        // setters definem valores para as propriedades, inserem, alteram e se necessário validam
        // ou seja, se necessario realiza alguma regra de negocio antes de alterar o valor da propriedade
        
        public function setCpf(string $cpf): void{
            $this->cpf = $cpf;
        }

        public function setName(string $name): void{
            $this->name = $name;
        }

        public function setEmail(string $email): void{
            $this->email = $email;
        }

        public function setTell(): string{
            return $this->tell;
        }
    }   
?>