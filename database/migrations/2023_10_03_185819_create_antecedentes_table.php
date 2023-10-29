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
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->increments('idantecedente');
            $table->BigInteger('iduser')->unsigned();
            $table->date('fecha')->default(DB::raw('CURRENT_DATE'));

            $table->boolean('tbcf')->nullable()->comment('0=no,1=si'); 
            $table->boolean('tbcp')->nullable()->comment('0=no,1=si'); 
            $table->boolean('diabetesf')->nullable()->comment('0=no,1=si'); 
            $table->boolean('diabetesp')->nullable()->comment('0=no,1=grado1,2=grado2,3=gravedad'); 
            $table->boolean('hipertensionf')->nullable()->comment('0=no,1=si'); 
            $table->boolean('hipertensionp')->nullable()->comment('0=no,1=si'); 
            $table->boolean('preeclampsiaf')->nullable()->comment('0=no,1=si'); 
            $table->boolean('preeclampsiap')->nullable()->comment('0=no,1=si'); 
            $table->boolean('eclampsiaf')->nullable()->comment('0=no,1=si'); 
            $table->boolean('eclampsiap')->nullable()->comment('0=no,1=si'); 
            $table->boolean('otrof')->nullable()->comment('0=no,1=si'); 
            $table->boolean('otrop')->nullable()->comment('0=no,1=si'); 
        
            $table->boolean('cirtracto')->nullable()->comment('0=no,1=si'); 
            $table->boolean('infertilidad')->nullable()->comment('0=no,1=si'); 
            $table->boolean('cardiopat')->nullable()->comment('0=no,1=si'); 
            $table->boolean('nefropatia')->nullable()->comment('0=no,1=si'); 
            $table->boolean('violencia')->nullable()->comment('0=no,1=si'); 
            $table->boolean('vih')->nullable()->comment('0=no,1=si'); 

            $table->boolean('ultimoprevions')->nullable()->comment('0=no,1= <2500g');
            $table->boolean('ultimoprevionormal')->nullable()->comment('0=no,1= >=4000g');
            $table->boolean('antecedentesgemelares')->nullable()->comment('0=no,1=si'); 
            $table->boolean('tresconsecutivos')->nullable()->comment('0=no,1=si'); 
            $table->integer('gestasprevias')->nullable(); 
            $table->integer('ectopico')->nullable(); 
            $table->integer('partos')->nullable(); 
            $table->integer('abortos')->nullable(); 
            $table->integer('vaginales')->nullable(); 
            $table->integer('cesareas')->nullable(); 
            $table->integer('nacidosvivos')->nullable(); 
            $table->integer('nacidosmuertos')->nullable(); 
            $table->integer('muertossemana')->nullable(); 
            $table->integer('muertosdespuessemana')->nullable(); 
            $table->integer('viven')->nullable(); 
            $table->date('finembarazoanterior')->nullable();
            $table->boolean('embarazoplaneado')->nullable()->comment('0=no,1=si'); 
            $table->integer('fracasometodo')->nullable()->comment('0=no usaba,1=barrera,2=diu,3=hormonal,4=emergencia,5=tradicional'); 
 
            $table->timestamps(); 
            $table->foreign('iduser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes');
    }
};
