<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->unsignedBigInteger('tipocliente_id')->nullable();
            $table->foreign('tipocliente_id')
                ->references('id_tipocliente')
                ->on('tipoclientes');
            $table->string('dniruc_cliente')->unique();
            $table->string('nombre_cliente');
            $table->string('direccion_cliente');
            $table->string('celular_cliente');
            $table->string('telefono_cliente')->nullable();
            $table->string('correo_cliente')->nullable();           
            $table->char('estranjero_cliente', 1); 
            $table->char('estado_cliente', 1); 
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
        Schema::dropIfExists('clientes');
    }
}
