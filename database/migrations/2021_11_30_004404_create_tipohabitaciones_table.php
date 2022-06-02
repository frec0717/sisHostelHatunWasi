<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipohabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipohabitaciones', function (Blueprint $table) {
            $table->id('id_tipohabitacion');
            $table->string('nombre_tipohabitacion')->unique();
            $table->string('descripcion_tipohabitacion')->nullable();
            $table->char('estado_tipohabitacion', 1);
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
        Schema::dropIfExists('tipohabitaciones');
    }
}
