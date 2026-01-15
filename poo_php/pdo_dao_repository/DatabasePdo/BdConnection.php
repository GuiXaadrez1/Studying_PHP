<?php

    // Principal objetivo deste arquivo é entender o que é o PDO do php

    // PDO != DE PADRAO DE PROJETO

    // Basicamente, PDO é uma API nativa do PHP que permite conexao com diversos SGBDS
    // Também é chamado de PHP Data Objects 
    // Em arquitetura de software é a cama de infraestrutura do banco de dados...

    // Ele resolve um único problema:

    // Como o PHP conversa com o banco de dados de forma segura e padronizada

    /*
        O que o PDO faz?

            Abre conexão com banco (MySQL, PostgreSQL, SQLite, etc.)

            Executa SQL

            Usa prepared statements

            Protege contra SQL Injection

            Retorna resultados
    */
    
    // Definindo namespace desta class
    // Identificador global = NomeNamespace + NomeElemento
    namespace Pdo\DatabasePdo;

    // require basicamente faz que o arquivo seja importado com todos as suas características
    // neste caso estamos importando as constantes de configuração do banco de dados
    require_once __DIR__ . "/../config.php";

    // Importe as classes do PHP no namespace global para este arquivo
    use PDO;
    use PDOException;

    // __DIR__  -> variável mágica que retorna o caminho absoluta da pasta do arquivo.php
    // __FILE__ ->  O caminho da pasta + o nome do arquivo

    // Criando uma conexao com banco de dados específica no padrao Singleton
    // ou seja, garantir que uma classe tenha apenas uma única instância em todo o ciclo 
    // de vida da requisição e fornecer um ponto global de acesso a ela.
    
    class BdConnection{
        
        // criando uma instancia stática vazia
        private static $instance = null;

        // Definimos uma propriedade para guardar a conexão
        private $pdo;

        private function __construct(){
            try {
                // Aqui você cria a conexão PDO, passando as contantes da configuracao
                $this->pdo = new PDO(BD.':host='.HOST.';dbname='.BD_NAME, USER, PASSWORD);

                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error connection: " . $e->getMessage());
            }
        }

        /**
         * Basicamente essa funcao verifica se a instancia ja existe 
         */
        public static function getInstance() {
            
            // Se a instancia for nula, ou seja, ainda nao foi criada
            if (self::$instance === null) {
                //Cria uma Nova instncia de conexao com o banco de dados
                self::$instance = new BdConnection();
            }
            return self::$instance;
        }

        // Método opcional para recuperar a conexão depois
        /**
         * basicamente pegamos uma instância do objeto PDO que representa a conexão com o banco de dados
         * e ter acesso aos métodos e propriedades do PDO para executar consultas SQL e interagir com o banco de dados.
         * return objeto PDO que representa a conexão com o banco de dados
         */
        public function getConnection() {
            //echo "Connected to " . BD_NAME . " database successfully! ";
            return $this->pdo;
        }

        // Usando palavra  mágica que impede clonagem do objeto (Segurança do Singleton)
        private function __clone() {}

        // no php podemos realizar uma clonagem profunda de um objeto usando o metodo clone()
    }

    // materializando a nossa class de acesso ao banco de dados (Singleton)
    //$db = BdConnection::getInstance();
    //$pdo = $db->getConnection();

    // Se você chamar de novo em outro arquivo:
    // $db2 = BdConnection::getInstance();
    // $db e $db2 são EXATAMENTE o mesmo objeto e a mesma conexão.
?>