<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('user_id');    
            $table->unsignedBigInteger('forma_pago_id');    
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('forma_pago_id')->references('id')->on('formas_pago');
            $table->integer('monto');
            $table->integer('estado');
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
        Schema::dropIfExists('compras');
    }
}
