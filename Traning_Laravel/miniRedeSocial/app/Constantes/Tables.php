<?php

    /*
        O arquivo dentro desta pasta de Constantes serve para padronizar
        os nomes das tabelas do banco de dados, evitando erros de digitação
        e facilitando a manutenção do código.

        lembre-se que o laravel usa o autoloader do composer, psr-4, entao
        a declaracao do namespace deve seguir a estrutura de pastas dentro
        da pasta app.
    */

    namespace App\Constantes;   

    class Tables{

        // como as constatnes são staticas, podemos acessa-las sem instanciar a classe
        // usando o operador de resplição de escopo, exemplo: Tables::USERS
        public const USERS = "users";
        public const PASSWORD_RESET_TOKENS = "password_reset_tokens";
        public const SESSIONS = "sessions";

        public const CATEGORIES = "categories";
        public const BOOKS = "books";
    };


?>