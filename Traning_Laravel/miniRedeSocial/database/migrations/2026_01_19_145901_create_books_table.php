<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


use App\Constantes\Tables;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Tables::BOOKS, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');

            // aqui estamos definindo campos opcionais, que podem ser nulos
            $table->string('cover')->nullable(); // tipo varchar para o caminho da capa do livro
            $table->text('description')->nullable(); // tipo text para descriçao do livro
            
            
            // agora vamos definiar as constraints de chave estrangeira
            // e a constraint de regras de deleção e atualizacap do tipo cascata ("nao receomendo usar em producao")
            // porque o tipo cascata apaga todos os livros relacionados a uma categoria ou usuario
            
            $table->foreignId('categoryId')->constrained(Tables::CATEGORIES)->onDelete('cascade');
            $table->foreignId('userId')->constrained(Tables::USERS)->onDelete('cascade');


            // lembrando que default é um constraint de valor padrao

            $table->boolean('complete')->default(false); // campo para indicar se o livro foi lido ou nao
            $table->boolean('favorite')->default(false); // campo para indicar se o livro é favorito

            // coluna que armazena a avaliação do livro, de 1 a 5 estrelas
            // tinyInteger é um inteiro pequeno, que ocupa menos espaço no banco de dados
            // unsigned significa que o valor nao pode ser negativo
            $table->tinyInteger('star')->unsigned()->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::BOOKS);
    }
};
