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
        Schema::create('despositos_pagos', function (Blueprint $table) {
            $table->id();
            
            $table->string('institucion_bancaria', 150);
            $table->string('tipo_cuenta', 50)->nullable();
            $table->string('numero_cuenta', 50)->nullable();
            $table->string('clabe_interbancaria', 50)->nullable();

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
        Schema::dropIfExists('despositos_pagos');
    }
};
