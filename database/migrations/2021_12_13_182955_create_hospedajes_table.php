<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedajes', function (Blueprint $table) {
            $table->id('id_hospedaje');
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
            $table->datetime('fechae_hospedaje');
            $table->datetime('fechas_hospedaje');
            $table->integer('npersona_hospedaje');
            $table->string('codigopago_hospedaje');
            $table->decimal('subt_hospedaje',11,2);
            $table->integer('descuento_hospedaje')->nullable();
            $table->decimal('igv_hospedaje',11,2)->nullable();
            $table->decimal('total_hospedaje',11,2);
            $table->char('condicion_hospedaje', 1);                       
            $table->char('porefe_hospedaje',1); 
            $table->char('estado_hospedaje', 1); 
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
        Schema::dropIfExists('hospedajes');
    }
}
