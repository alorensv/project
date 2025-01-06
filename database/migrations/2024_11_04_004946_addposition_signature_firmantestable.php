<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddpositionSignatureFirmantestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            $table->string('posicion_firma_y')->nullable()->after('dni');
            $table->string('posicion_firma_x')->nullable()->after('dni');
            $table->string('posicion_firma_pagina')->nullable()->after('dni');
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
