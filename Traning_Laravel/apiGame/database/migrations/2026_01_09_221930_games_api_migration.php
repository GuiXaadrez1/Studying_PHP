<?php

/*
    Apos criamos essa migracao e 

    Apos criarmos a classe Table com as constantes das tabelas do banco de dados
    Podemos usar ela em qualquer lugar do projeto desde que importemos ela corretamente
    usando esse padrao: 'Use App\Constantes\Table;' forma de importar classes em PHP

    devemos rodar o comando 'php artisan migrate' no terminal

*/

# importanto a classe Table que contem as constantes das tabelas do banco de dados
Use App\Constantes\Tables;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Tables::GAMES, function (Blueprint $table) {
            // quando nao define ->nullable(), o laravel coloca o padrao not null
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('thumb');
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
