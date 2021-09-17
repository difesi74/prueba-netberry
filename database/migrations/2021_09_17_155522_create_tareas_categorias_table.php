<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('tarea_id')->index();
            $table->unsignedBigInteger('categoria_id')->index();
            $table->foreign('tarea_id')->references('id')->on('tareas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->primary(['tarea_id', 'categoria_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas_categorias');
    }
}
