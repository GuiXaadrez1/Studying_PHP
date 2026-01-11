<?php

namespace App\Models;

/* Importando o nome dada tabela criada pela migration */

use App\Constantes\Tables;

use Illuminate\Database\Eloquent\Model;

/*

    Após a criacao da model o laravel automaticamente cria uma estrutura desta nossa model
    importanto da ORM o Eloquent para fazermos representacoes de tabelas no banco de dados
    realizar persistência e etc...

    Exatamente! É dentro da Classe Model que essa configuração deve morar.

    Na arquitetura MVC (Model-View-Controller) do Laravel, o Model é o responsável por toda
    a lógica de comunicação com o banco de dados. O $fillable funciona como o "segurança"
    da porta do banco.

*/

class Games extends Model
{

    // definindo atributo protegido

    protected $table = Tables::GAMES;

    /**
     * Atributos, campos que podem ser preenchidos em massa (Mass Assignment).
     * * Aqui listamos as colunas que permitimos que o usuário envie 
     * através de formulários ou requisições JSON da API.
     */
    protected $fillable = [
        'name', // coluna name
        'description', // coluna description
        'thumb', // coluna thumb
        'release_date' // realeases_date
    ];

}
