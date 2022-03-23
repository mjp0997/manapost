<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Al crear un envío findOrCreate un lote que tenga fecha_partida null y fecha_arribo null,
        // Si no existe se crea con los valores en null solo ingresando la ruta que debe tomar el envío
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_partida')->nullable()->default(null);
            $table->date('fecha_arribo')->nullable()->default(null);
            $table->foreignId('transporte_id')->nullable()->constrained('transportes');
            $table->foreignId('ruta_id')->constrained('rutas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
