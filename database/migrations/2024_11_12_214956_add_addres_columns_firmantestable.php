<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddresColumnsFirmantestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            $table->string('domicilio')->nullable()->after('dni');
            $table->string('comuna')->nullable()->after('domicilio');
            $table->string('region')->nullable()->after('comuna');
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
            //
        });
    }
}
