<?php

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
        Schema::create('coctels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del cóctel
            $table->text('description')->nullable(); // Descripción del cóctel (opcional)
            $table->string('photo')->nullable(); // Foto del cóctel (opcional)
            $table->text('ingredients')->nullable(); // Ingredientes del cóctel (opcional) 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con la tabla de usuarios
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coctels');
    }
};
