<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id('id_habitacion');
            $table->unsignedBigInteger('tipohabitacion_id')->nullable();
            $table->foreign('tipohabitacion_id')
                ->references('id_tipohabitacion')
                ->on('tipohabitaciones');  
            $table->unsignedBigInteger('piso_id')->nullable();
            $table->foreign('piso_id')
                ->references('id_piso')
                ->on('pisos');  
            $table->string('numero_habitacion')->unique();
            $table->decimal('precio_habitacion',11,2);
            $table->string('descripcion_habitacion',180)->nullable();
            $table->char('estado_habitacion', 1); 
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
        Schema::dropIfExists('habitaciones');
    }
}
