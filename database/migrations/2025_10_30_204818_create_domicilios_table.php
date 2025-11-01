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
        Schema::create('domicilios', function (Blueprint $table) {
            $table->id();
            $table->string('calle', 255);
            $table->string('numero_int', 50)->nullable();
            $table->string('numero_ext', 50)->nullable();
            $table->string('colonia', 150)->nullable();
            $table->string('codigo_postal', 20)->nullable();
            $table->string('municipio', 120)->nullable();
            $table->string('estado', 120)->nullable();
            $table->string('pais_residencia', 120)->nullable();

            // Relación con clientes (puede ser clientes_fisicas o clientes_morales según tu diseño)
            $table->foreignId('id_cliente')
                  ->nullable()
                  ->constrained('clientes')
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
        Schema::dropIfExists('domicilios');
    }
};
