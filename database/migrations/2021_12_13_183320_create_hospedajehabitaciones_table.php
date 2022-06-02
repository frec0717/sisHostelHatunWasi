<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedajehabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedajehabitaciones', function (Blueprint $table) {
            $table->id('id_hospedajehabitacion');
            $table->unsignedBigInteger('hospedaje_id')->nullable();
            $table->foreign('hospedaje_id')
                ->references('id_hospedaje')
                ->on('hospedajes');  
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->foreign('habitacion_id')
                ->references('id_habitacion')
                ->on('habitaciones');  
            $table->decimal('precio_hospedajehabitacion',11,2);
            $table->decimal('recargo_hospedajehabitacion',11,2)->nullable();
            $table->decimal('total_hospedajehabitacion',11,2);
            $table->char('porefe_hospedajehabitacion',1);
            $table->char('estado_hospedajehabitacion',1);
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
        Schema::dropIfExists('hospedajehabitaciones');
    }
}
