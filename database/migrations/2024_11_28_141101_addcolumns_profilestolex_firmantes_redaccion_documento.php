<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcolumnsProfilestolexFirmantesRedaccionDocumento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_firmantes_redaccion_documento', function (Blueprint $table) {
            $table->unsignedBigInteger('nacionalidad_id')->nullable()->after('region');   
            $table->unsignedBigInteger('estado_civil_id')->nullable()->after('nacionalidad_id');   
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidades');
            $table->foreign('estado_civil_id')->references('id')->on('estados_civiles');
            $table->string('profesion_oficio')->nullable()->after('estado_civil_id');            
            
            $table->index('nacionalidad_id');
            $table->index('estado_civil_id');
            $table->index('profesion_oficio');
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
