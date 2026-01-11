<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*

Aqui estamos criando uma migracao anonima que extende a classe Migration
e dentro dela temos dois metodos: up e down

up - usado para definir as acoes que serao executadas quando a migracao for aplicada

down - usado para definir as acoes que serao executadas quando a migracao for revertida

*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Aqui basicamente estamos criando tres tabelas padrao do Laravel:
         * 
         * users - para armazenar informacoes dos usuarios
         * password_reset_tokens - para armazenar tokens de reset de senha
         * sessions - para armazenar sessoes dos usuarios
         *  
         * Schema é uma class do Laravel que fornece uma interface para definir e manipular tabelas no banco de dados
         * Essa class representa o esquema do banco de dados e permite criar, modificar e excluir tabelas e colunas
         * 
         * Schema::create - metodo usado para criar uma nova tabela no banco de dados
         * 
         * Blueprint $table - usado para definir as colunas e seus tipos na tabela
         * Ou seja basicamente a Blueprint e a estrutura da tabela dentro da Migration
        */

        Schema::create('users', function (Blueprint $table) {
            $table->id(); # Cria uma coluna 'id' auto-incrementavel como chave primaria
            $table->string('name'); # Cria uma coluna 'name' do tipo string
            $table->string('email')->unique(); # Cria uma coluna 'email' do tipo string e unica
            $table->timestamp('email_verified_at')->nullable(); # Cria uma coluna 'email_verified_at' do tipo timestamp que pode ser nula
            $table->string('password');# Cria uma coluna 'password' do tipo string
            $table->rememberToken();# Cria uma coluna 'remember_token' do tipo string para lembrar sessao
            $table->timestamps(); # Cria colunas 'created_at' e 'updated_at' do tipo timestamp
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); # Cria uma coluna 'email' do tipo string como chave primaria
            $table->string('token');# Cria uma coluna 'token' do tipo string
            $table->timestamp('created_at')->nullable(); # Cria uma coluna 'created_at' do tipo timestamp que pode ser nula
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); # Remove a tabela 'users'
        Schema::dropIfExists('password_reset_tokens'); # Remove a tabela 'password_reset_tokens'
        Schema::dropIfExists('sessions'); # Remove a tabela 'sessions'
    }
};
