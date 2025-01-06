<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id(); // ID incremental
            $table->string('rut', 15)->unique(); // RUT, único y no nulo
            $table->string('nombres'); // Nombres, no nulo
            $table->string('apellidos')->nullable(); // Apellidos, nulleable
            $table->string('telefono')->nullable(); // Teléfono, nulleable
            $table->string('email')->nullable(); // Email, nulleable
            $table->string('img', 255)->nullable(); // Imagen, nulleable
            $table->enum('status', ['activo', 'inactivo']); // Status, enum
            $table->string('direccion', 255)->nullable(); // Dirección, nulleable
            $table->foreignId('cargo_id')->constrained('cargos'); // FK a cargos
            $table->timestamps();
            
            // Índices
            $table->index('rut'); // Índice para RUT
            $table->index('nombres'); // Índice para nombres
            $table->index('apellidos'); // Índice para apellidos
            $table->index('cargo_id'); // Índice para cargo_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
