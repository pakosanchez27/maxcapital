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
        Schema::create('informacion_credito', function (Blueprint $table) {
            $table->id();
            $table->decimal('importe_solicitado', 15, 2)->nullable();
            $table->integer('plazo_meses')->nullable();
            $table->string('producto_solicitado', 150)->nullable();
            $table->text('destino_credito')->nullable();

            // Relación con la tabla clientes
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
        Schema::dropIfExists('informacion_credito');
    }
};
