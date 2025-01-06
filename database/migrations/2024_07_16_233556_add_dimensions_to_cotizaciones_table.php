<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsToCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->string('largo')->nullable()->after('destino');
            $table->string('ancho')->nullable()->after('largo');
            $table->string('alto')->nullable()->after('ancho');
            $table->integer('peso')->nullable()->after('alto');
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
            $table->dropColumn(['largo', 'ancho', 'alto', 'peso']);
        });
    }
}
