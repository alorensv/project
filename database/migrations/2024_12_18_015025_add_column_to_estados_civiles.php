<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToEstadosCiviles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estados_civiles', function (Blueprint $table) {
            $table->enum('sexo', ['femenino', 'masculino'])->default('femenino')->after('nombre');
            $table->index('sexo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estados_civiles', function (Blueprint $table) {
            //
        });
    }
}
