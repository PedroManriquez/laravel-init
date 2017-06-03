<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            // se definen las respectivas columnas de la tabla
            $table->increments('id_pelicula');
            $table->date('anno_estreno');
            $table->string('nombre');
            $table->string('director',120);
            $table->text('sinopsis',120);
            $table->integer('id_genero')->unsigned();
            $table->foreign('id_genero')->references('id_genero')->on('generos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
