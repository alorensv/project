<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_productos', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('compra_id');    
            $table->unsignedBigInteger('producto_id');    
            $table->foreign('compra_id')->references('id')->on('compras');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->integer('cantidad');
            $table->integer('monto');
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
        Schema::dropIfExists('compra_productos');
    }
}
