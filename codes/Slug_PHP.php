<?php
    declare(strict_types=1); // ativando tipagem explícita!

    // o objetivo deste arquivo é aprender urls amigáveis, chamada de Slug
    // para isso vamos criar uma função com REGEX para fazer a filtragem de url "Sujas"

    $urlsSujas = [
        '/blog/artigo/o-que-e-php',          // slug simples, OK
        '/blog/artigo/O-QUE-E-PHP',          // maiúsculas (problema, slug costuma ser minúsculo)
        '/blog/artigo/2025-lancamento-php8', // slug numérico misto, OK
        '/blog/artigo/php_8-novidades',      // underline indesejado
        '/blog/artigo/php@8!novidades',      // caracteres especiais proibidos
        '/blog/artigo/',                     // slug ausente (incompleto)
        '/blog/artigo',                      // sem slug nem barra final
        '/blog/artigo///php-fail',           // barras repetidas
        '/blog/artigo/php-8-novidades.html', // extensão não esperada
        '/blog/artigo/..%2Fetc%2Fpasswd',    // tentativa de path traversal (perigoso)
        '/blog/artigo/este slug tem espaço', // espaço na URL, slug mal formado
        '/blog/artigo/este-slug-é-acentuado',// slug com acento, precisa suporte Unicode
    ];


    // Para cada url suja deste array, faça uma função que percorra cada url-string, limpe, e exiba na tela

    function Slug(array $string):string{
        
        try{

            $urlLimpa = "Apenas_Teste";
            return $urlLimpa;
        
        }catch(Throwable $e){

            return "Aconteceu algum erro aqui: " . $e->getMessage();
        }

    };

?>