<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLexDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lex_documentos', function (Blueprint $table) {
            $table->id(); // id incremental
            $table->string('nombre'); // varchar no null
            $table->string('descripcion', 255)->nullable(); // varchar con default null
            $table->string('imagen', 255)->nullable(); // varchar con default null
            $table->boolean('estado')->default(0); // status con default 0 (boolean: 0 y 1)
            $table->unsignedBigInteger('lex_categoria_id'); // FK firma_categoria_id

            // Definir clave foránea
            $table->foreign('lex_categoria_id')
                  ->references('id')
                  ->on('lex_categorias')
                  ->onDelete('cascade'); // Elimina en cascada si se borra la categoría

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lex_documentos');
    }
}
