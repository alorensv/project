<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_id')->constrained('tipos_equipo')->onDelete('cascade');
            $table->string('nombre')->nullable(false);
            $table->integer('anio')->nullable(false);
            $table->string('marca', 255)->nullable(false);
            $table->string('modelo')->nullable(false);
            $table->string('patente', 8)->nullable(false);
            $table->string('color')->nullable();
            $table->foreignId('subtipo_id')->nullable()->constrained('subtipos_equipo')->onDelete('set null');
            $table->string('link_ficha_tecnica', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->timestamps();

            $table->index(['marca', 'modelo', 'tipo_id', 'subtipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
