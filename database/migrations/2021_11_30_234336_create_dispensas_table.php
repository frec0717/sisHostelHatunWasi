<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispensasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispensas', function (Blueprint $table) {
            $table->id('id_dispensa');
            $table->unsignedBigInteger('categoriadispensa_id')->nullable();
            $table->foreign('categoriadispensa_id')
                ->references('id_categoriadispensa')
                ->on('categoriadispensas');
            $table->string('nombre_dispensa')->unique();
            $table->decimal('cantidad_dispensa',11,2);
            $table->decimal('precioc_dispensa',11,2);
            $table->decimal('preciov_dispensa',11,2);
            $table->date('fechav_dispensa')->nullable();    
            $table->string('descripcion_dispensa',180)->nullable();
            $table->char('estado_dispensa', 1); 
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
        Schema::dropIfExists('dispensas');
    }
}
