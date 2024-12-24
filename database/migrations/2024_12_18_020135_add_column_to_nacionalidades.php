<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToNacionalidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nacionalidades', function (Blueprint $table) {
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
        Schema::table('nacionalidades', function (Blueprint $table) {
            //
        });
    }
}
