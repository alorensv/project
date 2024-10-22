<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBase64AndFinalBase64ToLexUserRedactaDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_user_redacta_documento', function (Blueprint $table) {
            $table->longText('base64')->nullable()->after('ruta'); // Columna para guardar un base64 inicial
            $table->longText('final_base64')->nullable()->after('base64'); // Columna para guardar un base64 final
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lex_user_redacta_documento', function (Blueprint $table) {
            $table->dropColumn('base64');
            $table->dropColumn('final_base64');
        });
    }
}
