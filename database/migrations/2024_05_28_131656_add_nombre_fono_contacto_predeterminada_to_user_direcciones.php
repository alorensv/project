<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreFonoContactoPredeterminadaToUserDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_direcciones', function (Blueprint $table) {
            $table->string('nombre_contacto')->nullable()->after('user_id');
            $table->string('fono_contacto')->nullable()->after('nombre_contacto');
            $table->boolean('is_default')->default(0)->after('fono_contacto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_direcciones', function (Blueprint $table) {
            $table->dropColumn('nombre_contacto');
            $table->dropColumn('fono_contacto');
            $table->dropColumn('is_default');
        });
    }
}
