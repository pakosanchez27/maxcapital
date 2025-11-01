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
        Schema::create('contactos_cobranza', function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre', 150);
            $table->string('puesto', 100)->nullable();
            $table->string('telefono_oficina', 20)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('telefono_personal', 20)->nullable();
            $table->string('email', 255)->nullable();

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
        Schema::dropIfExists('contactos_cobranza');
    }
};
