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
        Schema::create('morales', function (Blueprint $table) {
            $table->id();
            
            $table->string('razon_social', 255);
            $table->string('giro', 150)->nullable();
            $table->string('rfc', 13)->nullable();
            $table->date('fecha_constitucion')->nullable();
            $table->string('pais_constitucion', 120)->nullable();
            $table->string('nacionalidad', 120)->nullable();
            $table->string('numero_serie_fiel', 100)->nullable();
            $table->string('numero_condusef', 100)->nullable();

            // Relación con clientes (ajusta el nombre de la tabla si difiere)
            $table->foreignId('id_cliente')
                  ->nullable()
                  ->constrained('clientes') // Cambia 'clientes' si tu tabla es distinta
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('morales');
    }
};
