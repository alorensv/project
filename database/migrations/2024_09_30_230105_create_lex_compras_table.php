<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLexComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lex_compras', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('user_id')->nullable();   
            $table->string('guest_id')->nullable();  
            $table->unsignedBigInteger('institucion_id');    
            $table->unsignedBigInteger('forma_pago_id');    
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('forma_pago_id')->references('id')->on('formas_pago');
            $table->integer('monto');
            $table->integer('estado');
            $table->integer('ultimos_num_tarjeta')->nullable()->default(null);
            $table->dateTime('fecha_transaccion')->nullable()->default(null);
            $table->integer('codigo_auth')->default(0);
            $table->string('codigo_tipo_transaccion', 4)->nullable()->default(null);
            $table->integer('num_cuotas')->nullable()->default(null);

            $table->foreign('institucion_id')
                  ->references('id')
                  ->on('lex_instituciones')
                  ->onDelete('cascade'); // Eliminar en cascada si se borra la institución
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
        Schema::dropIfExists('lex_compras');
    }
}
