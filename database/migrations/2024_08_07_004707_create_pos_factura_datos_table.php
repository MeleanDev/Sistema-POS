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
        Schema::create('pos_factura_datos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('cliente')->nullable();
            $table->float('pagado')->nullable();
            $table->string('metodoPago')->nullable();
            $table->float('pagoBS')->nullable()->default(0);
            $table->float('pagoDolares')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pos_factura_datos');
    }
};
