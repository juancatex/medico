<?php

namespace App\Http\Controllers;

use App\Models\GestacionActual;
use Illuminate\Http\Request;

class GestacionActualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function gestactuser(Request $request)
    { 
       return GestacionActual::where('iduser',$request->id)->first();     
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        GestacionActual::updateOrInsert(
            ['iduser' => $request->iduser],
            [
            'pesoanterior' => $request->pesoanterior, 
            'talla' => $request->talla, 
            'imc' => $request->imc, 
            'evaluacionnutricional' => $request->evaluacionnutricional, 
            'fppdate' => $request->fppdate, 
            'fumdate' => $request->fumdate, 
            'fum' => $request->fum, 
            'eco' => $request->eco, 
            'fumaact1' => $request->fumaact1, 
            'fumaact2' => $request->fumaact2, 
            'fumapas1' => $request->fumapas1, 
            'fumapas2' => $request->fumapas2, 
            'drogas1' => $request->drogas1, 
            'drogas2' => $request->drogas2, 
            'alcohol1' => $request->alcohol1, 
            'alcohol2' => $request->alcohol2, 
            'violencia1' => $request->violencia1, 
            'violencia2' => $request->violencia2, 
            'natirubeola' => $request->natirubeola, 
            'antitetanicavigente' => $request->antitetanicavigente, 
            'dosis1' => $request->dosis1, 
            'dosis2' => $request->dosis2, 
            'odont' => $request->odont, 
            'mamas' => $request->mamas, 
            'pap' => $request->pap, 
            'colp' => $request->colp, 
            'grupo' => $request->grupo, 
            'rh' => $request->rh, 
            'inmuniz' => $request->inmuniz, 
            'antid' => $request->antid, 
            'glicemia20' => $request->glicemia20, 
            'glicemia20105' => $request->glicemia20105, 
            'glicemia30' => $request->glicemia30, 
            'glicemia30105' => $request->glicemia30105, 
            'hbmenor' => $request->hbmenor, 
            'anemiamenor' => $request->anemiamenor, 
            'hierro' => $request->hierro, 
            'folatos' => $request->folatos, 
            'hbmayor' => $request->hbmayor, 
            'anemiamayor' => $request->anemiamayor, 
            'vihsolmenor' => $request->vihsolmenor, 
            'vihpruebamenor' => $request->vihpruebamenor, 
            'vihtratmenor' => $request->vihtratmenor, 
            'vihsolmayor' => $request->vihsolmayor, 
            'vihpruebamayor' => $request->vihpruebamayor, 
            'vihtratmayor' => $request->vihtratmayor, 
            'sifilismenorrpr' => $request->sifilismenorrpr, 
            'sifilismenor20' => $request->sifilismenor20, 
            'sifilismenortrat' => $request->sifilismenortrat, 
            'sifilismenor' => $request->sifilismenor, 
            'sifilismenortratpareja' => $request->sifilismenortratpareja, 
            'sifilismayorrpr' => $request->sifilismayorrpr, 
            'sifilismayor20' => $request->sifilismayor20, 
            'sifilismayortrat' => $request->sifilismayortrat, 
            'sifilismayor' => $request->sifilismayor, 
            'sifilismayortratpareja' => $request->sifilismayortratpareja, 
            'planeadoparto' => $request->planeadoparto, 
            'orientacion' => $request->orientacion, 
            'orina' => $request->orina, 
            'bacteriuriamenor' => $request->bacteriuriamenor, 
            'bacteriuriamayor' => $request->bacteriuriamayor, 
            'chagas' => $request->chagas, 
            'paludismo' => $request->paludismo, 
            'estreptococo' => $request->estreptococo, 
            'toxoplasmosismenor' => $request->toxoplasmosismenor, 
            'toxoplasmosismayor' => $request->toxoplasmosismayor, 
            'toxoplasmosisconsulta' => $request->toxoplasmosisconsulta
            ]
                 
        );   
             
        return redirect('/GestacionActual');
    }

    /**
     * Display the specified resource.
     */
    public function show(GestacionActual $gestacionActual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GestacionActual $gestacionActual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GestacionActual $gestacionActual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GestacionActual $gestacionActual)
    {
        //
    }
}
