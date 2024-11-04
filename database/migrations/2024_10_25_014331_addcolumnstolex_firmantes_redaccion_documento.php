<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcolumnstolexFirmantesRedaccionDocumento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            // Eliminar la columna apellidos
            //$table->dropColumn('apellidos');
            
            // Agregar las nuevas columnas
            $table->string('apellido_paterno')->nullable(false)->after('nombres');
            $table->string('apellido_materno')->nullable(false)->after('apellido_paterno');
            $table->integer('IdUsuarioECert')->nullable()->default(null)->after('dni');
            $table->integer('DoctoId')->nullable()->default(null)->after('base64');
            $table->text('base64_enviado')->nullable()->default(null)->after('base64');
            $table->boolean('firmado')->nullable()->default(null)->after('base64_enviado');
            $table->string('razon_rechazo')->nullable()->default(null)->after('firmado');

            // Crear índices en las columnas IdUsuarioECert y DoctoId
            $table->index('IdUsuarioECert');
            $table->index('DoctoId');
            $table->index('dni');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            // Volver a agregar la columna apellidos
            $table->string('apellidos')->nullable(false);

            // Eliminar las nuevas columnas
            $table->dropColumn('apellido_paterno');
            $table->dropColumn('apellido_materno');
            $table->dropColumn('IdUsuarioECert');
            $table->dropColumn('DoctoId');
            $table->dropColumn('base64_enviado');
            $table->dropColumn('firmado');
            $table->dropColumn('razon_rechazo');

            // Eliminar índices
            $table->dropIndex(['IdUsuarioECert']);
            $table->dropIndex(['DoctoId']);
        });
    }
}
