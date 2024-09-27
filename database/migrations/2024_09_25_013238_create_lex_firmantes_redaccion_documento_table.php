<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLexFirmantesRedaccionDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            $table->id(); // id incremental
            $table->unsignedBigInteger('lex_redaccion_id'); // FK hacia lex_user_redacta_documento
            $table->string('nombres'); // varchar not null
            $table->string('apellidos'); // varchar not null
            $table->string('correo'); // varchar not null
            $table->string('dni'); // varchar not null
            $table->boolean('estado')->default(0); // estado con 0 y 1, default 0

            // Definir clave foránea
            $table->foreign('lex_redaccion_id')
                  ->references('id')
                  ->on('lex_user_redacta_documento')
                  ->onDelete('cascade'); // Eliminar en cascada si se borra la redacción

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
        Schema::dropIfExists('lex_firmantes_redaccion_documento');
    }
}
