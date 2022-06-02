<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id('id_reservacion');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');      
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')
                ->references('id_cliente')
                ->on('clientes');
            $table->unsignedBigInteger('formapago_id')->nullable();
            $table->foreign('formapago_id')
                ->references('id_formapago')
                ->on('formapagos');            
            $table->unsignedBigInteger('emisionderecibo_id')->nullable();
            $table->foreign('emisionderecibo_id')
                ->references('id_emisionderecibo')
                ->on('emisionderecibos');            
            $table->datetime('fechae_reservacion');
            $table->datetime('fechas_reservacion');
            $table->integer('npersona_reservacion');
            $table->string('codigopago_reservacion');
            $table->decimal('subt_reservacion',11,2);
            $table->integer('descuento_reservacion')->nullable();
            $table->decimal('igv_reservacion',11,2)->nullable();
            $table->decimal('total_reservacion',11,2);
            $table->char('condicion_reservacion', 1);             
            $table->char('porefe_reservacion',1);
            $table->char('estado_reservacion', 1); 
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
        Schema::dropIfExists('reservaciones');
    }
}
