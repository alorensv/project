<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLexCompraServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lex_compra_servicios', function (Blueprint $table) {
            $table->id(); // Campo id incremental
            $table->foreignId('lex_compra_id')->constrained('lex_compras')->onDelete('cascade'); // Clave foránea a lex_compras
            $table->foreignId('lex_user_redacta_documento_id')->constrained('lex_user_redacta_documento')->onDelete('cascade'); // Clave foránea a lex_user_redacta_documento
            $table->integer('cantidad'); // Campo cantidad de tipo integer
            $table->integer('monto'); // Campo monto de tipo integer
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lex_compra_servicios');
    }
}
