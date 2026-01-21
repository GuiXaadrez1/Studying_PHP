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
        Schema::create(Tables::CATEGORIES, function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('slug')->unique();
            // Lembrando que os campos create_at e update_at sao criados automaticamente
            // pelo metodo timestamps() do laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Tables::CATEGORIES);
    }
};
