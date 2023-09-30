<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provincias', function (Blueprint $table) {
            $table->increments('idprovincia');
            $table->integer('iddepartamento')->unsigned(); 
            $table->string('nomprovincia',30); 
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('iddepartamento')->references('iddepartamento')->on('departamentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provincias');
    }
};
