<?php
    
    # Aqui vai ficar nossas contantes que podem ser mescladas com a .env
    
    # 1. Namespace sempre no topo
    namespace config;

    # 2. Imports
    use App\config\database\ConnectionSingleton;

    # 3. Configurações e Sessão (Antes de qualquer HTML)
    session_start(); 

    # Definido constantes: 

    # Se usar const, ela fica como config\BASE_URL_VIEW
    # const BASE_URL_VIEW = "/Studying_PHP/front_raiz_js_php_html_css/register-me/public/assets/css/";

    define("BASE_URL_VIEW", "/Studying_PHP/front_raiz_js_php_html_css/register-me/public/assets/");

?>