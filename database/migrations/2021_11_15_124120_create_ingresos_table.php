<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id('id_ingreso');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');          
            $table->date('fecha_ingreso',180);
            $table->string('nombre_ingreso',180);
            $table->string('descripcion_ingreso',255)->nullable();
            $table->string('nrecibo_ingreso',180)->nullable();
            $table->decimal('monto_ingreso',11,2);
            $table->char('estado_ingreso', 1);
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
        Schema::dropIfExists('ingresos');
    }
}
