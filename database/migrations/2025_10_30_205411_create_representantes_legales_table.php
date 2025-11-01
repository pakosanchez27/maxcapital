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
        Schema::create('representantes_legales', function (Blueprint $table) {
            $table->id();
              $table->string('nombres', 150);
            $table->string('apellidos', 150)->nullable();
            $table->integer('edad')->unsigned()->nullable();
            $table->string('ocupacion', 120)->nullable();
            $table->string('genero', 20)->nullable();

            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento', 120)->nullable();
            $table->string('pais_nacimiento', 120)->nullable();
            $table->string('nacionalidad', 120)->nullable();

            // México
            $table->string('curp', 18)->nullable(); // 18 caracteres
            $table->string('rfc', 13)->nullable();  // 12/13 caracteres

            $table->string('estado_civil', 40)->nullable();
            $table->string('regimen_conyugal', 80)->nullable();

            $table->string('email', 255)->nullable(); // ->unique() si aplica
            $table->string('numero_serial_fiel', 100)->nullable();
            $table->string('tipo_identificacion', 80)->nullable();
            $table->string('folio_identificacion', 100)->nullable();

            // Relación con clientes (ajusta el nombre de la tabla referenciada si es distinto)
            $table->foreignId('id_cliente')
                  ->nullable()
                  ->constrained('clientes')  // cambia 'clientes' si tu tabla difiere
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
        Schema::dropIfExists('representantes_legales');
    }
};
