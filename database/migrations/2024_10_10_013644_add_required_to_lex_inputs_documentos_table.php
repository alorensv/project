<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequiredToLexInputsDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lex_inputs_documentos', function (Blueprint $table) {
            $table->boolean('required')->default(false)->before('orden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lex_inputs_documentos', function (Blueprint $table) {
            $table->dropColumn('required');
        });
    }
}
