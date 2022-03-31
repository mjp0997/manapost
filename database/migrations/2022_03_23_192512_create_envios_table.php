<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Para determinar el status de un envío se usa la relación con el lote,
        // si fecha_partida == null entonces se encuentra en espera,
        // si fecha_partida != null && fecha_arribo == null entonces se encuentra en traslado,
        // si fecha_partida != null && fecha_arribo != null entonces se encuentra en destino.
        
        // "fecha_retiro" para determinar si fue retirado en la agencia destino por el cliente.
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_consignacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('fecha_retiro')->nullable();
            $table->string('descripcion');
            $table->decimal('peso', 10, 2);
            $table->decimal('monto', 10, 2);
            $table->foreignId('remitente_id')->constrained('clientes');
            $table->foreignId('destinatario_id')->constrained('clientes');
            $table->foreignId('lote_id')->constrained('lotes');
            $table->foreignId('consignatario_id')->constrained('empleados');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envios');
    }
}
