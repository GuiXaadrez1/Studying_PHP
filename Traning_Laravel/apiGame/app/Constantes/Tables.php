<?php
# Criando essa classe para armazenar os nomes das tabelas do banco de dados
# Apenas para fins didáticos

# Um namespace atua como um pacote (package) 
# Agora podemos usar ela em qualquer lugar do projeto
# desde que importemos ela corretamente usando esse padrao: 'Use App\Constantes\Table;'
namespace App\Constantes;

class Tables{
    # Definindo uma constante para o nome da tabela users
    public const  GAMES  = 'games';
}

?>