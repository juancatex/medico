<?php

namespace App\Http\Controllers;

use App\Models\ControlPrenatal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlPrenatalController extends Controller
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
    public function getregistros(Request $request)
    { 
       return ControlPrenatal::select('control_prenatals.*','users.name') 
       ->leftJoin('users', function($join) {
        $join->on('users.id', '=', 'control_prenatals.responsable')->where('users.activo',1);
      })
      ->where('control_prenatals.iduser',$request->id)
      ->orderBy('control_prenatals.idprenat', 'asc')->get();     
    }
    public function getregistrostrat(Request $request)
    {  
        $fecha_actual = date("Y-m-d"); 
       return ['fecha'=>date("Y-m-d",strtotime($fecha_actual."+ 1 month")),'datos'=>ControlPrenatal::where('idprenat',$request->id)->first()];     
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
    $request->validate([ 
        'peso' => 'required|numeric',
        'imc' => 'required|numeric',
        'pa' => 'required|string',
        'edadgest' => 'required|numeric',  
        'alturauterina' => 'required|numeric',  
        'presentacion' => 'required|numeric' 
    ]);
    
        $hasExpenseSavedForUser = ControlPrenatal::where('asisfecha',date("Y-m-d"))
        ->where('iduser', $request->iduser)
        ->exists();

        if ($hasExpenseSavedForUser) {
            return back()->withErrors([
                'asisfecha' => 'Ya existe un registro previo'
            ]);
        }

    $Activo = ControlPrenatal::create($request->input());  
    $Activo->save();
    return redirect('/ControlPrenatal');  
    }

    /**
     * Display the specified resource.
     */
    public function show(ControlPrenatal $controlPrenatal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $request->validate([  
            'tratamientos' => 'required|string',
            'proximacita' => 'required' 
        ]);

        $ControlPrenatal = ControlPrenatal::find($request->idprenat); 
        $ControlPrenatal->tratamientos=$request->tratamientos;
        $ControlPrenatal->proximacita=$request->proximacita;
        $ControlPrenatal->responsable=Auth::id();
        $ControlPrenatal->save();
        return redirect('/ControlPrenatalTrat');  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ControlPrenatal $controlPrenatal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ControlPrenatal $controlPrenatal)
    {
        //
    }
}
