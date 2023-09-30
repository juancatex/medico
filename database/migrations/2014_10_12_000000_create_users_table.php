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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('idrol')->unsigned(); 
            $table->integer('iddepartamento')->unsigned(); 
            $table->integer('idprovincia')->unsigned();  
            $table->string('name');
            $table->string('genero',2)->comment('M=masculino,F=femenino'); 
            $table->integer('ci'); 
            $table->date('fechanacimiento');
            $table->string('matricula')->nullable();
            $table->integer('telefono')->nullable();
            $table->integer('telfamiliar')->nullable();
            $table->string('dir',500)->nullable();
            $table->string('email')->unique()->nullable(); 
            $table->string('password');
            $table->longText('foto')->nullable();

            $table->integer('edad')->nullable();
            $table->string('zona',100)->nullable();
            $table->string('red',100)->nullable();
            $table->string('idioma',100)->nullable();
            $table->string('lengua',100)->nullable(); 
            $table->integer('autoidentificacion')->default(0)->comment('0=ninguno,40=mestiza,41=blanca,42=otra'); 
            $table->boolean('alfabeta')->default(0);
            $table->integer('estudios')->default(0)->comment('0=ninguno,1=primaria,2=secundaria,3=universidad'); 
            $table->integer('nivelanios')->default(0)->comment('anios en el mayor nivel'); 
            $table->integer('estadocivil')->default(0)->comment('0=casada,1=union libre,2=soltera,3=otro'); 
            $table->integer('vivesola')->default(0)->comment('0=no,1=si'); 
            $table->string('controlprenatalen',100)->nullable(); 
            $table->string('partoen',100)->nullable(); 
            $table->string('cip',100)->nullable()->comment('ci del paciente'); 
            $table->string('numhisclinico',100)->nullable()->comment('numero de historial clinico'); 

            $table->rememberToken();
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idrol')->references('idrol')->on('rols');
            $table->foreign('iddepartamento')->references('iddepartamento')->on('departamentos');
            $table->foreign('idprovincia')->references('idprovincia')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
