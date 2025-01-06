<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenFirmantestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            $table->string('token')->nullable()->after('DoctoId');
            $table->timestamp('expires_at')->nullable()->after('token');
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
            $table->dropColumn('token');
            $table->dropColumn('expires_at');
        });
    }
}
