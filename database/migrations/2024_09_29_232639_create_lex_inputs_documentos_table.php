<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLexInputsDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lex_inputs_documentos', function (Blueprint $table) {
            $table->increments('id'); // ID auto incremental
            $table->unsignedBigInteger('documento_id'); // FK hacia lex_documentos
            $table->string('name', 255); // Nombre del campo (ej. Nombre, RUT, Comuna)
            $table->string('label', 255); // Etiqueta que verá el usuario (ej. Ingresa tu nombre)
            $table->string('placeholder', 255)->nullable(); // Texto de ejemplo
            $table->enum('field_type', ['text', 'date', 'integer'])->default('text'); // Tipo de campo (text, date, integer)
            $table->integer('orden'); // Posición en el texto
            $table->timestamps();

            $table->foreign('documento_id')
                  ->references('id')
                  ->on('lex_documentos')
                  ->onDelete('cascade'); // Eliminar en cascada si se borra el documento
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lex_inputs_documentos');
    }
}
