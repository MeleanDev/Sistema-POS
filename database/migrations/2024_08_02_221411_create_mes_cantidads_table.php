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
        Schema::create('mes_cantidads', function (Blueprint $table) {
            $table->id();
            $table->string('mes');
            $table->float('cantidadesBS')->nullable()->default(0);
            $table->float('cantidadesDolar')->nullable()->default(0);
            $table->float('cantidadeTotal')->nullable()->default(0);
            $table->integer('compras')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mes_cantidads');
    }
};
