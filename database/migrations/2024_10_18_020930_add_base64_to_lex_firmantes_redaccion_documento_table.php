<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBase64ToLexFirmantesRedaccionDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            $table->longText('base64')->nullable()->after('estado');
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
            $table->dropColumn('base64');
        });
    }
}
