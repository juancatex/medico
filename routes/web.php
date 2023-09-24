<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
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

Route::get('/dashboard', function () {
    $now = Carbon::now(); 
    return Inertia::render('Dashboard',['time'=>$now->format('A'),'name'=>Auth::user()->name]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::fallback(function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userin', [ProfileController::class, 'userin'])->name('userin');

    Route::get('/Enfermera', [ProfileController::class, 'listarEnfermera'])->name('Enfermeras'); 
    Route::get('/Paciente', [ProfileController::class, 'listarPaciente'])->name('Pacientes'); 
    Route::get('/Doctor', [ProfileController::class, 'listarDoctor'])->name('Doctores'); 
});

require __DIR__.'/auth.php';
