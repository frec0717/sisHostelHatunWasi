<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriadispensasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriadispensas', function (Blueprint $table) {
            $table->id('id_categoriadispensa');
            $table->string('nombre_categoriadispensa')->unique();
            $table->string('descripcion_categoriadispensa')->nullable();
            $table->char('estado_categoriadispensa', 1);
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
        Schema::dropIfExists('categoriadispensas');
    }
}
