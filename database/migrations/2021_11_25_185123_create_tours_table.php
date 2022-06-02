<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id('id_tour');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')
                ->references('id_empresa')
                ->on('empresas');
            $table->date('fechai_tour');    
            $table->date('fechaf_tour');    
            $table->string('nombre_tour');
            $table->string('descripcion_tour',180)->nullable();
            $table->char('estado_tour', 1); 
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
        Schema::dropIfExists('tours');
    }
}
