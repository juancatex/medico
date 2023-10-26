<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AntecedenteController;
use App\Http\Controllers\GestacionActualController;
use App\Http\Controllers\ControlPrenatalController;
use Illuminate\Foundation\Application;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){ 
        return redirect()->intended(RouteServiceProvider::HOME);
    }else{
        return redirect()->route('login');
    }
});

// Route::get('/dashboard', function () {
//     $now = Carbon::now(); 
//     return Inertia::render('Dashboard',['time'=>$now->format('A'),'name'=>Auth::user()->name]);
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::fallback(function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('/seguridad', [ProfileController::class, 'seguridad'])->name('seguridad');
    Route::put('/Seguridadupdate', [ProfileController::class, 'update'])->name('Seguridadupdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userin', [ProfileController::class, 'userin'])->name('userin');

    Route::get('/CarnetPerinatal', [ProfileController::class, 'listarPacienteCarnetperinatal'])->name('CarnetPerinatal');  
    Route::get('/CarnetperinatalLista', [ProfileController::class, 'listarPacienteCarnetperinatalLista'])->name('CarnetperinatalLista');  
    Route::get('/pdflistadoin', [ProfileController::class, 'pdflistadoin'])->name('pdflistadoin');  
    Route::get('/ControlPrenatal', [ProfileController::class, 'listarPacienteControlprenatal'])->name('ControlPrenatal');  
    Route::get('/ControlPrenatalTrat', [ProfileController::class, 'listarPacienteControlprenataltrat'])->name('ControlPrenatalTrat');  
    Route::get('/GestacionActual', [ProfileController::class, 'listarPacienteGestacionActual'])->name('GestacionActual');  
    Route::get('/Antecedentes', [ProfileController::class, 'listarPacienteAntecedente'])->name('Antecedentes'); 

    Route::get('/Reporte1', [ProfileController::class, 'rep1'])->name('Reporte1'); 
    Route::get('/Reporte2', [ProfileController::class, 'rep2'])->name('Reporte2'); 
    Route::get('/Reporte3', [ProfileController::class, 'rep3'])->name('Reporte3'); 
    Route::get('/Reporte4', [ProfileController::class, 'rep4'])->name('Reporte4'); 
    Route::get('/Reporte5', [ProfileController::class, 'rep5'])->name('Reporte5'); 
    Route::get('/Reporte6', [ProfileController::class, 'rep6'])->name('Reporte6'); 
    Route::get('/Reporte7', [ProfileController::class, 'rep7'])->name('Reporte7'); 

    Route::get('/obtenerregistros', [ControlPrenatalController::class, 'getregistros'])->name('obtenerregistros'); 
    Route::get('/obtenerregistrostrat', [ControlPrenatalController::class, 'getregistrostrat'])->name('obtenerregistrostrat'); 
    Route::post('/RegControlPrenatal', [ControlPrenatalController::class, 'store'])->name('RegControlPrenatal'); 
    Route::post('/RegControlPrenatalDoc', [ControlPrenatalController::class, 'edit'])->name('RegControlPrenatalDoc'); 

    Route::get('/obtenergestacionActual', [GestacionActualController::class, 'gestactuser'])->name('obtenergestacionActual'); 
    Route::post('/Reggestacionactual', [GestacionActualController::class, 'store'])->name('Reggestacionactual'); 

    Route::get('/obtenerantecedentes', [AntecedenteController::class, 'anteuser'])->name('obtenerantecedentes'); 
    Route::post('/RegAntecedentes', [AntecedenteController::class, 'store'])->name('RegAntecedentes'); 

    Route::get('/Paciente', [ProfileController::class, 'listarPaciente'])->name('Pacientes'); 
    Route::post('/RegPaciente', [ProfileController::class, 'storePaciente'])->name('RegPaciente'); 
    Route::put('/ActualizarPaciente', [ProfileController::class, 'updatePaciente'])->name('ActualizarPaciente');  
    Route::post('/EliminarPaciente', [ProfileController::class, 'deletepaciente'])->name('EliminarPaciente'); 

    Route::get('/Enfermera', [ProfileController::class, 'listarEnfermera'])->name('Enfermeras'); 
    Route::post('/RegEnfermera', [ProfileController::class, 'storeenfermera'])->name('RegEnfermera'); 
    Route::put('/ActualizarEnfermera', [ProfileController::class, 'updateEnfermera'])->name('ActualizarEnfermera'); 
    Route::post('/EliminarEnfermera', [ProfileController::class, 'deleteEnfermera'])->name('EliminarEnfermera'); 

    Route::get('/Doctor', [ProfileController::class, 'listarDoctor'])->name('Doctores'); 
    Route::post('/RegDoctor', [ProfileController::class, 'storedoctor'])->name('RegDoctor'); 
    Route::put('/ActualizarDoctor', [ProfileController::class, 'updatedoctor'])->name('ActualizarDoctor'); 
    Route::post('/EliminarDoctor', [ProfileController::class, 'deletedoctor'])->name('EliminarDoctor'); 

    Route::put('/ActualizarPacientePass', [ProfileController::class, 'resetpassPaciente'])->name('ActualizarPacientePass'); 
    Route::put('/ActualizarDoctorPass', [ProfileController::class, 'resetpassDoc'])->name('ActualizarDoctorPass'); 
    Route::put('/ActualizarEnfPass', [ProfileController::class, 'resetpassEnf'])->name('ActualizarEnfPass'); 
});

require __DIR__.'/auth.php';
