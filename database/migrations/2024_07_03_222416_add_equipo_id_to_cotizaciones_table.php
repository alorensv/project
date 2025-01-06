<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEquipoIdToCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('equipo_id')->nullable()->after('destino');
            
            $table->foreign('equipo_id')
                  ->references('id')
                  ->on('equipos')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropForeign(['equipo_id']);
            $table->dropColumn('equipo_id');
        });
    }
}
