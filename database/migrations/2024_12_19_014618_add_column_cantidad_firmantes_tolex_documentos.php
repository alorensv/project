<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCantidadFirmantesTolexDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_documentos', function (Blueprint $table) {
            $table->integer('cantidad_firmantes')->default(1)->after('default_text_plural');
            $table->index('cantidad_firmantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lex_documentos', function (Blueprint $table) {
            //
        });
    }
}
