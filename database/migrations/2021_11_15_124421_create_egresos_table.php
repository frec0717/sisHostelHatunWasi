<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id('id_egreso');
            $table->unsignedBigInteger('id_user')->unsigned();
            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->date('fecha_egreso',180);
            $table->string('nombre_egreso',180);
            $table->string('descripcion_egreso',255)->nullable();
            $table->string('nrecibo_egreso',180)->nullable();
            $table->decimal('monto_egreso',11,2);
            $table->char('estado_egreso', 1);
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
        Schema::dropIfExists('egresos');
    }
}
