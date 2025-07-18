<?php

    // ativando a tipagem explícita! 
    declare(strict_types = 1);

    // Este arquivo.php visa explicar os MetaCaracteres especiais de quantificação + e * 

    // Eles tem um funcionamento bem parecido com o MetaCaracter ?, ou seja, aquele  caracter anterior a ele
    // se for * pode ter existência sem limite ou nenhuma existência 
    // agora se for +  pode ter existência sem limite ou ao menos uma existência

    // boa prática, semmpre tente usar o mínimo de caracteres para buscar, validar alguma coisa com o regex para não trazer complexidade

    // vamos começar com o asterisco * significa -> existência sem limite ou nenhum existencia dequele caracter

    // exemplo: /vo*a/ -> podemos retonar as ocorrências: voo,voooooo,vooo,voooooa,voooa,voa,etc...

    // agora vamos ver um exemplo com o mais + -> pode ter existência sem limite ou ao menos uma existência

    // /vrau+a/ -> voa (não entra), vrauaaa (entra), 


    // Crie duas funções usando os dois tipos de quantificadores

    function filtrar_string1(string $string): string{

    };

   function filtrar_string2(string $string): string {

   };




?>