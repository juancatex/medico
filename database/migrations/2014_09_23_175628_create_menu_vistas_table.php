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
        Schema::create('menu_vistas', function (Blueprint $table) {
            $table->increments('idmenuvista'); 
            $table->integer('idmenu')->unsigned(); 
            $table->integer('idv')->unsigned();   
            $table->timestamps();
            $table->foreign('idmenu')->references('idmenu')->on('menus');
            $table->foreign('idv')->references('idv')->on('vistas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_vistas');
    }
};
