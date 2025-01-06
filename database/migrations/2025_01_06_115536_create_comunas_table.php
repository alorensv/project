<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunas', function (Blueprint $table) {
            $table->string('codigo', 10)->primary();
            $table->string('tipo', 50);
            $table->string('nombre', 100);
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('url', 255)->default('');
            $table->string('codigo_padre', 10);
            $table->string('codigo_region', 10)->notNullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunas');
    }
}
