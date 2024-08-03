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
        Schema::create('empresa_datos', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nempresa');
            $table->string('rif');
            $table->string('rsocial');
            $table->string('correo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('pais');
            $table->string('estado');
            $table->string('ciudad');
            $table->string('cpostal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_datos');
    }
};
