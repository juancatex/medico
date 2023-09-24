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
        Schema::create('rolmenus', function (Blueprint $table) {
            $table->increments('idrolmenu');
            $table->integer('idrol')->unsigned(); 
            $table->integer('idmenu')->unsigned();   
            $table->timestamps();
            $table->foreign('idrol')->references('idrol')->on('rols');
            $table->foreign('idmenu')->references('idmenu')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolmenus');
    }
};
