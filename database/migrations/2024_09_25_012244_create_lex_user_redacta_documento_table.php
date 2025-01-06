<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLexUserRedactaDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lex_user_redacta_documento', function (Blueprint $table) {
            $table->id(); // id incremental
            $table->unsignedBigInteger('user_id'); // FK hacia users
            $table->unsignedBigInteger('documento_id'); // FK hacia lex_documentos
            $table->unsignedBigInteger('institucion_id'); // FK hacia lex_instituciones
            $table->json('redaccion'); // columna para almacenar JSON
            $table->integer('estado')->default(0); // estado con integer, default 0
            $table->string('ruta')->nullable(); // ruta con default null

            // Definir claves foráneas
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Eliminar en cascada si se borra el usuario
                  
            $table->foreign('documento_id')
                  ->references('id')
                  ->on('lex_documentos')
                  ->onDelete('cascade'); // Eliminar en cascada si se borra el documento

            $table->foreign('institucion_id')
                  ->references('id')
                  ->on('lex_instituciones')
                  ->onDelete('cascade'); // Eliminar en cascada si se borra la institución

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
        Schema::dropIfExists('lex_user_redacta_documento');
    }
}
