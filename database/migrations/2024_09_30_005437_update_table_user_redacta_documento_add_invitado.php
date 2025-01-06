<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateTableUserRedactaDocumentoAddInvitado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE lex_user_redacta_documento MODIFY user_id BIGINT UNSIGNED NULL');

        Schema::table('lex_user_redacta_documento', function (Blueprint $table) {
            $table->string('guest_id')->nullable(); // Almacena el identificador del invitado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
