<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmisionderecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emisionderecibos', function (Blueprint $table) {
            $table->id('id_emisionderecibo');
            $table->string('nombre_emisionderecibo',180);
            $table->char('estado_emisionderecibo', 1);            
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
        Schema::dropIfExists('emisionderecibos');
    }
}
