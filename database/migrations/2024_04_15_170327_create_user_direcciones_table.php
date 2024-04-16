<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('region', 255);
            $table->string('comuna', 255);
            $table->string('direccion', 255);
            $table->string('codigo_postal', 255);
            $table->unsignedBigInteger('user_id');       
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_direcciones');
    }
}
