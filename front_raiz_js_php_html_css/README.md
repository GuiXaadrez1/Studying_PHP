# Introduction 

This repository was created to build side projects while studying the fundamentals of web programming, server-side architecture, and front-end/back-end development. The programming type is OOP (Object-Oriented Programming).

## Technologies to be studiend (Tech Stack)

- PHP (version 7.x or 8.x);
- XAMPP(version)
- HTML5, CSS, and JavaScript;
- GIT/GITHUB;
- POWER_SHELL or BASH commands;
- Databases: MySQL, PostgreSQL, or SQLite

## Arquiteture project -> Client-Server vs Server-Side 

### Architecture Overview (English) 

This project is built on the Client-Server Architecture, specifically focusing on Server-Side Development. The core logic is structured using the MVC (Model-View-Controller) pattern, enhanced by the Singleton design pattern for database management.

### Key Differences: 

- Client-Server vs. Server-SideClient-Server (The System Model):

    - It is the "big picture." It defines the relationship between the Client (Browser/User) and the Server (XAMPP/PHP). It represents the communication flow ($Request \rightarrow Response$).
    
- Server-Side (The Execution Logic): 
    
    - It is the "engine room." It refers to everything that happens strictly inside the server. This is where our MVC and Singleton patterns live, processing data before sending it back to the client.

### Technical Implementation

- MVC Pattern: Separates the business logic (Model) from the user interface (View) using a mediator (Controller).

- Singleton Pattern: Ensures a single, efficient connection to the database (MySQL/PostgreSQL), preventing resource waste.

## Visão Geral da Arquitetura (Portiguês)

Este projeto é construído sobre a Arquitetura Cliente-Servidor, focando especificamente no Desenvolvimento Server-Side. A lógica central é estruturada utilizando o padrão MVC (Model-View-Controller), reforçado pelo padrão de projeto Singleton para o gerenciamento do banco de dados.

### Diferenças Chave: Cliente-Servidor vs. Server-Side

- Cliente-Servidor (O Modelo do Sistema): 

    - É a "visão geral". Define a relação entre o Cliente (Navegador/Usuário) e o Servidor (XAMPP/PHP). Representa o fluxo de comunicação ($Requisição \rightarrow Resposta$).

- Server-Side (A Lógica de Execução): 
    
    - É a "sala de máquinas". Refere-se a tudo o que acontece estritamente dentro do servidor. É aqui que nossos padrões MVC e Singleton residem, processando os dados antes de enviá-los de volta ao cliente.

### Implementação Técnica

- Padrão MVC: Separa a lógica de negócios (Model) da interface do usuário (View) através de um mediador (Controller).

- Padrão Singleton: Garante uma conexão única e eficiente com o banco de dados (MySQL/PostgreSQL), evitando o desperdício de recursos.

### complementação dos conceitos acima em Português

- Arquitetura Cliente-Servidor: É o Modelo de Rede. Ele descreve o relacionamento entre dois computadores: um que pede dados (o Cliente/Navegador) e um que fornece (o Servidor/XAMPP).

- Server-Side (Lado do Servidor): Refere-se à Localização da lógica. É tudo o que roda "dentro" do servidor (seu PHP, o padrão MVC e o Singleton). O usuário nunca vê esse código fonte, apenas o resultado.

- Client-Side (Lado do Cliente): É o que roda no navegador (Browser -> Google, Edgar, FireFox) do usuário renderizando (HTML, CSS e JavaScript).

- Em resumo: Sim, a arquitetura Client-Server é literalmente a soma do Server-side + Client-side. É o ecossistema completo.

## Design Patterns MVC + SINGLETON

- English

I'll use the MVC + Singleton pattern in this project for educational purposes, with the main goal of understanding web programming fundamentals. The MVC (Model-View-Controller) architecture organizes the application into three layers: the Model manages data and business logic, the View handles the user interface, and the Controller acts as an intermediary, processing inputs and coordinating the other layers.  The Singleton pattern will be used to manage the database connection, ensuring that only one instance of this connection exists during the script's execution, which promotes efficiency and centralizes database access.

- Portguês-Brasil:

rei usar o padrão MVC + Singleton neste projeto para fins didáticos, com o principal objetivo de entender os fundamentos da programação web. O MVC (Model-View-Controller) organiza a aplicação em três camadas: o Model gerencia os dados e a lógica de negócio, o View cuida da interface com o usuário, e o Controller atua como intermediário, processando as entradas e coordenando as outras camadas.  O Singleton será usado para gerenciar a conexão com o banco de dados, garantindo que apenas uma instância dessa conexão exista durante a execução do script, o que promove eficiência e centraliza o acesso ao banco.



## Exemple desing pattern Singleton + MVC

```php
<?php
// Arquivo: Database.php (Singleton)
class Database {
    private static $instance = null;
    private $pdo;

    // Construtor privado para prevenir 'new Database()'
    private function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=test", "user", "pass");
    }

    // Método estático para obter a única instância
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Método para obter a conexão PDO
    public function getConnection() {
        return $this->pdo;
    }
}

// Arquivo: UserModel.php (Model)
class UserModel {
    private $db;

    public function __construct() {
        // Obtém a conexão do Singleton
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllUsers() {
        // Usa a mesma conexão em toda a aplicação
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}

// Uso em qualquer lugar do projeto
$userModel = new UserModel();
$users = $userModel->getAllUsers();
```


- English

The MVC (Model-View-Controller) architecture you will use is a standard design pattern for web applications. The Model manages the data and business logic, interacting with the database.  

The View is responsible for the presentation layer, displaying data to the user.  

The Controller acts as an intermediary, receiving user input from the View, processing it (often by calling the Model), and returning the result. 

The Singleton design pattern is used to manage the database connection.  It ensures that only one instance of the Database class exists throughout the application's execution. 

The UserModel communicates with this Singleton by calling Database::getInstance()->getConnection(), which returns the single, shared PDO connection object. This prevents multiple, redundant database connections and centralizes connection management.

- Portiguês-Brasil

A arquitetura MVC que você usará é um padrão de design padrão para aplicações web. O Modelo gerencia os dados e a lógica de negócios, interagindo com o banco de dados.  

A Visualização (View) é responsável pela camada de apresentação, exibindo os dados para o usuário. 

O Controlador (Controller) atua como intermediário, recebendo a entrada do usuário da Visualização, processando-a (geralmente chamando o Modelo (Model) ) e retornando o resultado.


O padrão de projeto Singleton é usado para gerenciar a conexão com o banco de dados.  Ele garante que apenas uma instância da classe Database exista durante toda a execução da aplicação. 

O UserModel se comunica com este Singleton chamando Database::getInstance()->getConnection(), que retorna o único objeto de conexão PDO compartilhado. 

Isso evita conexões múltiplas e redundantes com o banco de dados e centraliza o gerenciamento da conexão.