<?php
    // ativando tipagem explícita do php
    declare(strict_types=1);

    // O objetivo deste código php é aprender o que chamo de IF E ELSE do REGEX

    // RECOMENDO QUE LEIA OS ARQUIVOS NO CAMINHO:
    // C:\xampp\htdocs\Studying_PHP\RegEx_exercícios\anotações
    // para entender a fundo o que está acontecendo aqui

    // A grosso modo!

    // Nosso (?=...) positive lookahead. Ou IF, se exitir retornar (IF)
    // exemplo: (?= combinação de expressões Regulares) /

    //Nosso (?!...) → negative lookahead. Else, se não existir, retornar (ElSE)
    //exemplo: / (?!= combinação de expressões Regulares) /
    
    
    // Vou colocar dois exemplos Reais

    // exemplo1: /Jennifer(?=\sLopez)/
    // Estamos selecionando o "Jennifer" que possui "Lopez" depois.
    // O match NÃO inclui o "Lopez", só "Jennifer".

    // exemplo2: /Jennifer(?!\sLopez)/
    // Estamos selecionando o "Jennifer" que NÃO possui "Lopez" depois.
    // O match é só "Jennifer", pois o negativo filtra quem não tem "Lopez".
    
    // Exercício

    // Dada uma lista de nomes, Retorne todos os que possuem Silva
    // Usando o Regex com seu IF e Else
    // use for normal para iteirar sobre o array 

    $nomes = [
        "Ana Silva",
        "Bruno Costa",
        "Carla Mendes",
        "Diego Souza",
        "Elaine Rocha",
        "Felipe Martins",
        "Gabriela Lima",
        "Henrique Duarte",
        "Isabela Nunes",
        "João Moreira",
        "Karen Barbosa",
        "Lucas Ferreira",
        "Mariana Pinto",
        "Natália Gomes",
        "Otávio Ribeiro",
        "Paula Cardoso",
        "Rafael Teixeira",
        "Sandra Freitas",
        "Thiago Pires",
        "Vanessa Monteiro",
        'G . Silva'
    ];

    // essa bagaceira aqui vai ser forte! 
    function filtrar_nomes(array $lista_nomes):string{
        try{
            $validacao_array = is_array($lista_nomes)?true:false;

            $lista_nomes_filtrado = [];

            if($validacao_array==true){

                for($i=0;$i<count($lista_nomes);$i++){
                    
                    preg_match_all('/[A-Z]\s*?.*?\s*?(?=Silva)Silva$/',$lista_nomes[$i],$matches);

                    if(isset($matches[0][0]) && !empty($matches[0][0])){
                        $lista_nomes_filtrado[] = $matches[0][0];
                    }
                    else{
                        $lista_nomes_filtrado[] = '0';
                    };
                
                };

                $nomes_filtrados = implode('<br>',array_filter($lista_nomes_filtrado, function($nome){return $nome !== '0'; }));

                return "Nomes filtrados da nossa lista: <br>" . $nomes_filtrados;

            }else{
                return "Lista de nomes inválida, por favor, verificar integridade da lista.";
            };
        }catch(Throwable $e){
            return "Error " . $e -> getMessage();
        };
    };


    echo filtrar_nomes($nomes);

?>