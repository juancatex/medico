<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('control_prenatals', function (Blueprint $table) {
            $table->increments('idprenat');
            $table->BigInteger('iduser')->unsigned();
            $table->date('asisfecha')->default(DB::raw('CURRENT_DATE'));
            $table->float('peso')->nullable(); 
            $table->float('imc')->nullable(); 
            $table->string('pa')->nullable(); 
            $table->float('edadgest')->nullable(); 
            $table->float('alturauterina')->nullable(); 
            $table->boolean('presentacion')->nullable()->comment('0=cefálico (cef), 1=pelviana (pel), 2=incluye la situación transversa (tra)');  
            $table->float('fcf')->nullable(); 
            $table->string('movimfetales')->nullable(); 
            $table->string('proteinuria')->nullable(); 
            $table->integer('numtabferroso')->nullable(); 
            $table->text('tratamientos')->nullable(); 
            $table->BigInteger('responsable')->nullable(); 
            $table->date('proximacita')->nullable(); 
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('iduser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_prenatals');
    }
};
