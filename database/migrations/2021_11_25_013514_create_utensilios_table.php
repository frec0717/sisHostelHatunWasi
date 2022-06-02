<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtensiliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utensilios', function (Blueprint $table) {
            $table->id('id_utensilio');
            $table->unsignedBigInteger('tipoutensilio_id');
            $table->foreign('tipoutensilio_id')
                ->references('id_tipoutensilio')
                ->on('tipoutensilios');
            $table->string('nombre_utensilio',180);
            $table->decimal('cantidad_utensilio',11,2);    
            $table->string('descripcion_utensilio',180)->nullable();
            $table->char('estado_utensilio', 1); 
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
        Schema::dropIfExists('utensilios');
    }
}
