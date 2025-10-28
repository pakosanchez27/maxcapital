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
        Schema::create('credit_type_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_type_id');
            $table->unsignedBigInteger('document_id');
            $table->foreign('credit_type_id')->references('id')->on('credit_type')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_credit_type_documents');
    }
};
