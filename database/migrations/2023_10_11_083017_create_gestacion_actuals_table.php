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
        Schema::create('gestacion_actuals', function (Blueprint $table) {
            $table->increments('idgesact');
            $table->BigInteger('iduser')->unsigned();

            $table->float('pesoanterior')->nullable(); 
            $table->integer('talla')->nullable(); 
            $table->float('imc')->nullable(); 
            $table->boolean('evaluacionnutricional')->nullable()->comment('0=E,1=N,2=S,3=O'); 
            $table->date('fppdate')->nullable();
            $table->date('fumdate')->nullable();
            $table->boolean('fum')->nullable()->comment('0=no,1=si'); 
            $table->boolean('eco')->nullable()->comment('0=no,1=si'); 

            $table->boolean('fumaact1')->nullable()->comment('0=no,1=si'); 
            $table->boolean('fumaact2')->nullable()->comment('0=no,1=si'); 
            $table->boolean('fumapas1')->nullable()->comment('0=no,1=si');  
            $table->boolean('fumapas2')->nullable()->comment('0=no,1=si'); 
            $table->boolean('drogas1')->nullable()->comment('0=no,1=si');  
            $table->boolean('drogas2')->nullable()->comment('0=no,1=si'); 
            $table->boolean('alcohol1')->nullable()->comment('0=no,1=si');  
            $table->boolean('alcohol2')->nullable()->comment('0=no,1=si'); 
            $table->boolean('violencia1')->nullable()->comment('0=no,1=si');  
            $table->boolean('violencia2')->nullable()->comment('0=no,1=si'); 
            $table->boolean('natirubeola')->nullable()->comment('0=previa,1=nosabe,2=embarazo,3=no'); 
            $table->boolean('antitetanicavigente')->nullable()->comment('0=no,1=si'); 
            $table->boolean('dosis1')->nullable()->comment('0=no,1=si'); 
            $table->boolean('dosis2')->nullable()->comment('0=no,1=si'); 
            $table->boolean('odont')->nullable()->comment('0=no,1=si'); 
            $table->boolean('mamas')->nullable()->comment('0=no,1=si'); 

            $table->boolean('pap')->nullable()->comment('0=normal,1=anormal,2=nose hizo'); 
            $table->boolean('colp')->nullable()->comment('0=normal,1=anormal,2=nose hizo'); 
            $table->string('grupo')->nullable()->comment('A, B, AB, O'); 
            $table->boolean('rh')->nullable()->comment('0=-,1=+'); 
            $table->boolean('inmuniz')->nullable()->comment('0=no,1=si'); 
            $table->boolean('antid')->nullable()->comment('0=no,1=si,2=n/c');
            $table->float('glicemia20')->nullable(); 
            $table->boolean('glicemia20105')->nullable()->comment('0=no,1=si'); 
            $table->float('glicemia30')->nullable(); 
            $table->boolean('glicemia30105')->nullable()->comment('0=no,1=si');
            $table->float('hbmenor', 6, 2)->nullable();
            $table->boolean('anemiamenor')->nullable()->comment('0=no,1=si');
            $table->boolean('hierro')->nullable()->comment('0=no,1=si');
            $table->boolean('folatos')->nullable()->comment('0=no,1=si');
            $table->float('hbmayor', 6, 2)->nullable();
            $table->boolean('anemiamayor')->nullable()->comment('0=no,1=si');
            $table->boolean('vihsolmenor')->nullable()->comment('0=no,1=si');
            $table->boolean('vihpruebamenor')->nullable()->comment('0=-,1=+,2=n/c,3=s/d');
            $table->boolean('vihtratmenor')->nullable()->comment('0=no,1=si,2=n/c'); 
            $table->boolean('vihsolmayor')->nullable()->comment('0=no,1=si');
            $table->boolean('vihpruebamayor')->nullable()->comment('0=-,1=+,2=n/c,3=s/d');
            $table->boolean('vihtratmayor')->nullable()->comment('0=no,1=si,2=n/c');
            $table->boolean('sifilismenorrpr')->nullable()->comment('0=-,1=+,2=s/d');
            $table->float('sifilismenor20')->nullable(); 
            $table->boolean('sifilismenortrat')->nullable()->comment('0=-,1=+,2=s/d,3=n/c');
            $table->float('sifilismenor')->nullable(); 
            $table->boolean('sifilismenortratpareja')->nullable()->comment('0=no,1=si,2=s/d,3=n/c');
            $table->boolean('sifilismayorrpr')->nullable()->comment('0=-,1=+,2=s/d');
            $table->float('sifilismayor20')->nullable(); 
            $table->boolean('sifilismayortrat')->nullable()->comment('0=-,1=+,2=s/d,3=n/c');
            $table->float('sifilismayor')->nullable(); 
            $table->boolean('sifilismayortratpareja')->nullable()->comment('0=no,1=si,2=s/d,3=n/c');

            $table->boolean('planeadoparto')->nullable()->comment('0=no,1=si');
            $table->boolean('orientacion')->nullable()->comment('0=no,1=si');
            $table->boolean('orina')->nullable()->comment('0=no,1=si');
            $table->boolean('bacteriuriamenor')->nullable()->comment('0=normal,1=anormal,2=nose hizo');
            $table->boolean('bacteriuriamayor')->nullable()->comment('0=normal,1=anormal,2=nose hizo');
            $table->boolean('chagas')->nullable()->comment('0=-,1=+,2=nose hizo');
            $table->boolean('paludismo')->nullable()->comment('0=-,1=+,2=nose hizo');
            $table->boolean('estreptococo')->nullable()->comment('0=-,1=+,2=nose hizo');
            $table->boolean('toxoplasmosismenor')->nullable()->comment('0=-,1=+,2=nose hizo');
            $table->boolean('toxoplasmosismayor')->nullable()->comment('0=-,1=+,2=nose hizo');
            $table->boolean('toxoplasmosisconsulta')->nullable()->comment('0=-,1=+,2=nose hizo');

            $table->timestamps();
            $table->foreign('iduser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestacion_actuals');
    }
};
