<?php

namespace App\Http\Controllers;

use App\Models\Antecedente;
use Illuminate\Http\Request;

class AntecedenteController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          
        Antecedente::updateOrInsert(
            ['iduser' => $request->iduser],
            ['tbcf' => $request->tbcf,
            'tbcp' => $request->tbcp,
            'diabetesf' => $request->diabetesf,
            'diabetesp' => $request->diabetesp,
            'hipertensionf' => $request->hipertensionf,
            'hipertensionp' => $request->hipertensionp,
            'preeclampsiaf' => $request->preeclampsiaf,
            'preeclampsiap' => $request->preeclampsiap,
            'eclampsiaf' => $request->eclampsiaf,
            'eclampsiap' => $request->eclampsiap,
            'otrof' => $request->otrof,
            'otrop' => $request->otrop,
            'cirtracto' => $request->cirtracto,
            'infertilidad' => $request->infertilidad,
            'cardiopat' => $request->cardiopat,
            'nefropatia' => $request->nefropatia,
            'violencia' => $request->violencia,
            'vih' => $request->vih,
            'ultimoprevions' => $request->ultimoprevions,
            'ultimoprevionormal' => $request->ultimoprevionormal,
            'antecedentesgemelares' => $request->antecedentesgemelares,
            'tresconsecutivos' => $request->tresconsecutivos,
            'gestasprevias' => $request->gestasprevias,
            'ectopico' => $request->ectopico,
            'partos' => $request->partos,
            'abortos' => $request->abortos,
            'vaginales' => $request->vaginales,
            'cesareas' => $request->cesareas,
            'nacidosvivos' => $request->nacidosvivos,
            'nacidosmuertos' => $request->nacidosmuertos,
            'muertossemana' => $request->muertossemana,
            'muertosdespuessemana' => $request->muertosdespuessemana,
            'viven' => $request->viven,
            'finembarazoanterior' => $request->finembarazoanterior,
            'embarazoplaneado' => $request->embarazoplaneado,
            'fracasometodo' => $request->fracasometodo,
            ]
        );   
             
        return redirect('/Antecedentes');
    }
    public function anteuser(Request $request)
    { 
       return Antecedente::where('iduser',$request->id)->first();     
    }

    /**
     * Display the specified resource.
     */
    public function show(Antecedente $antecedente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antecedente $antecedente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antecedente $antecedente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antecedente $antecedente)
    {
        //
    }
}
