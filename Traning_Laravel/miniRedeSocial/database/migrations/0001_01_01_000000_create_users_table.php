<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// importando a nossa class de constantes de tabelas criada
use App\Constantes\Tables;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Tables::USERS, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // aqui basicamente estamos adicionando um campo 
            // com a constraint unique assim que o campo email for criado
            // $table->string('username')->unique()->after('email');
            // ou opte pela solucao mais simples... Crie o campo normalmente 
            // adicionando a constraint unique depois da criacao do campo email
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // colocando bio na tabela nativa de usuarios do Laravel
            // com no máximo 500 caracteres, ele é nullable, aceita valores nulos
            $table->string("bio",500)->nullable();
            $table->string("photo",150)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
