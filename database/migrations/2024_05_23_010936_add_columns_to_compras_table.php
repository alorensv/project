<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->integer('ultimos_num_tarjeta')->nullable()->default(null);
            $table->dateTime('fecha_transaccion')->nullable()->default(null);
            $table->integer('codigo_auth')->default(0);
            $table->string('codigo_tipo_transaccion', 4)->nullable()->default(null);
            $table->integer('num_cuotas')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('compras', function (Blueprint $table) {
            $table->dropColumn('ultimos_num_tarjeta');
            $table->dropColumn('fecha_transaccion');
            $table->dropColumn('codigo_auth');
            $table->dropColumn('codigo_tipo_transaccion');
            $table->dropColumn('num_cuotas');
        });
    }
}
