<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionhabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacionhabitaciones', function (Blueprint $table) {
            $table->id('id_reservacionhabitacion');
            $table->unsignedBigInteger('reservacion_id')->nullable();
            $table->foreign('reservacion_id')
                ->references('id_reservacion')
                ->on('reservaciones');  
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->foreign('habitacion_id')
                ->references('id_habitacion')
                ->on('habitaciones');  
            $table->decimal('precio_reservacionhabitacion',11,2);
            $table->decimal('recargo_reservacionhabitacion',11,2)->nullable();
            $table->decimal('total_reservacionhabitacion',11,2);
            $table->char('porefe_reservacionhabitacion',1);
            $table->char('estado_reservacionhabitacion',1);
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
        Schema::dropIfExists('reservacionhabitaciones');
    }
}
