<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('ruc_empresa',11)->unique();
            $table->string('razonsocial_empresa')->unique();
            $table->string('direccion_empresa')->unique();
            $table->string('celular_empresa')->unique();
            $table->string('telefono_empresa')->nullable();
            $table->string('descripcion_empresa')->nullable();
            $table->char('estado_empresa', 1);
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
        Schema::dropIfExists('empresas');
    }
}
