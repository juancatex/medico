<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Rolmenu;
use App\Models\MenuVista;
use App\Models\Departamento;
use App\Models\Provincia;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
    public function listarEnfermera(Request $request): Response
    {  
        $enfermeras= User::where('activo',1)
        ->where('idrol',3) ;
        if(!empty($request->search)){ 
            $enfermeras=$enfermeras->where('name','like',"%$request->search%") ; 
        }
        $enfermeras=$enfermeras->orderBy('name')->paginate(5); 
        
        $dep= Departamento::where('activo',1)->orderBy('iddepartamento')->get();    

        $prov=[];
        if(!empty($request->dep)){
            $prov= Provincia::where('activo',1)->where('iddepartamento',$request->dep)->orderBy('nomprovincia')->get(); 
        } 

        return Inertia::render('Enfermera', [ 
            'lista' =>  $enfermeras,
            'dep' =>  $dep,
            'prov' =>  $prov,
        ]);

    }
    public function listarPaciente(Request $request): Response
    {
          
        $pacientes= User::where('activo',1)
        ->where('idrol',4) ;
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('name')->paginate(5); 
        
        $dep= Departamento::where('activo',1)->orderBy('iddepartamento')->get();    

        $prov=[];
        if(!empty($request->dep)){
            $prov= Provincia::where('activo',1)->where('iddepartamento',$request->dep)->orderBy('nomprovincia')->get(); 
        } 
        $autoidentificacion=[
            [
                "id" => 1,
                "name" => "Afroboliviano"
            ],
            [
                "id" => 2,
                "name" => "araona"
            ],
            [
                "id" => 3,
                "name" => "Aymara"
            ],
            [
                "id" => 4,
                "name" => "Ayoreo"
            ],
            [
                "id" => 40,
                "name" => "Mestiza"
            ],
            [
                "id" => 41,
                "name" => "Blanca"
            ],
            [
                "id" => 42,
                "name" => "Otra"
            ]
        ];
       
        return Inertia::render('Paciente', [ 
            'lista' =>  $pacientes,
            'dep' =>  $dep,
            'prov' =>  $prov,
            'autoid' =>  $autoidentificacion,
        ]);
    }
    public function listarPacienteAntecedente(Request $request): Response
    {
          
        $pacientes= User::where('activo',1)
        ->where('idrol',4) ;
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('name')->paginate(5); 
         
        return Inertia::render('Antecedentes', [ 
            'lista' =>  $pacientes, 
        ]);
    }
    public function listarDoctor(Request $request): Response
    {
        $Pacientes= User::where('activo',1)
        ->where('idrol',2) ;
        if(!empty($request->search)){ 
            $Pacientes=$Pacientes->where('name','like',"%$request->search%") ; 
        }
        $Pacientes=$Pacientes->orderBy('name')->paginate(5); 
        
        $dep= Departamento::where('activo',1)->orderBy('iddepartamento')->get();    

        $prov=[];
        if(!empty($request->dep)){
            $prov= Provincia::where('activo',1)->where('iddepartamento',$request->dep)->orderBy('nomprovincia')->get(); 
        } 

        return Inertia::render('Doctor', [ 
            'lista' =>  $Pacientes,
            'dep' =>  $dep,
            'prov' =>  $prov,
        ]);
    }
    public function storedoctor(Request $request)
    { 
        $request->validate([ 
            'name' => 'required|string|max:255',  
            'iddepartamento' => 'required|numeric',
            'idprovincia' => 'required|numeric',  
            'ci' => 'required|numeric',  
            'genero' => 'required|string',  
            'telefono' => 'required|numeric',    
            'email' => 'required|email|unique:users',  
            'matricula' => 'required',  
            'dir' => 'required',  
            'fechanacimiento' => 'required' 
        ]);
       

        $doctor=User::create([
            'name' => $request->name,
            'idrol' => $request->idrol,
            'iddepartamento' => $request->iddepartamento,
            'idprovincia' => $request->idprovincia,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'telfamiliar' => $request->telfamiliar,
            'fechanacimiento' => $request->fechanacimiento,
            'matricula' => $request->matricula,
            'dir' => $request->dir,
            'email' => $request->email,
            'foto' => $request->foto,
            'genero' => $request->genero,
            'password' =>  bcrypt($request->ci)
        ]);   
        $doctor->save();

        return redirect('/Doctor');
    }
    public function storePaciente(Request $request)
    { 
        $request->validate([ 
            'name' => 'required|string|max:255',  
            'dir' => 'required',  
            'iddepartamento' => 'required|numeric', 
            'idprovincia' => 'required|numeric', 
            'telefono' => 'required|numeric',
            'fechanacimiento' => 'required',
            'email' => 'required|email|unique:users',  
            'edad' => 'required|numeric',  
            'autoidentificacion' => 'required|numeric',  
            'alfabeta' => 'required|numeric',  
            'estudios' => 'required|numeric',  
            'nivelanios' => 'required|numeric',  
            'estadocivil' => 'required|numeric',  
            'vivesola' => 'required|numeric',  
            'cip' => 'required',  
            'ci' => 'required|numeric', 
            'numhisclinico' => 'required' 
        ]);
          


        $paciente=User::create([
            'name' => $request->name,
            'idrol' => $request->idrol,
            'dir' => $request->dir,
            'zona' => $request->zona,
            'red' => $request->red,
            'iddepartamento' => $request->iddepartamento,
            'idprovincia' => $request->idprovincia,
            'telefono' => $request->telefono,
            'idioma' => $request->idioma,
            'lengua' => $request->lengua,
            'email' => $request->email,
            'edad' => $request->edad,
            'fechanacimiento' => $request->fechanacimiento,
            'autoidentificacion' => $request->autoidentificacion,
            'alfabeta' => $request->alfabeta,
            'estudios' => $request->estudios,
            'nivelanios' => $request->nivelanios,
            'estadocivil' => $request->estadocivil,
            'vivesola' => $request->vivesola,
            'controlprenatalen' => $request->controlprenatalen,
            'partoen' => $request->partoen,
            'cip' => $request->cip,
            'ci' => $request->ci,
            'numhisclinico' => $request->numhisclinico,
            'foto' => $request->foto,
            'genero' => "F",
            'password' =>  bcrypt($request->cip)
        ]);    
        $paciente->save();

        return redirect('/Paciente');
    }
    public function storeenfermera(Request $request)
    { 
        $request->validate([ 
            'name' => 'required|string|max:255',  
            'iddepartamento' => 'required|numeric',
            'idprovincia' => 'required|numeric',  
            'ci' => 'required|numeric',  
            'genero' => 'required|string',  
            'telefono' => 'required|numeric',    
            'email' => 'required|email|unique:users',  
            'matricula' => 'required',  
            'dir' => 'required',  
            'fechanacimiento' => 'required' 
        ]);
       

        $doctor=User::create([
            'name' => $request->name,
            'idrol' => $request->idrol,
            'iddepartamento' => $request->iddepartamento,
            'idprovincia' => $request->idprovincia,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'telfamiliar' => $request->telfamiliar,
            'fechanacimiento' => $request->fechanacimiento,
            'matricula' => $request->matricula,
            'dir' => $request->dir,
            'email' => $request->email,
            'foto' => $request->foto,
            'genero' => $request->genero,
            'password' =>  bcrypt($request->ci)
        ]);   
        $doctor->save();

        return redirect('/Enfermera');
    }
    public function updatedoctor(Request $request)
    { 
        $activo = User::findOrFail($request->id);
        $activo->name = $request->name; 
        $activo->iddepartamento = $request->iddepartamento; 
        $activo->idprovincia = $request->idprovincia; 
        $activo->ci = $request->ci; 
        $activo->telefono = $request->telefono; 
        $activo->telfamiliar = $request->telfamiliar; 
        $activo->fechanacimiento = $request->fechanacimiento; 
        $activo->matricula = $request->matricula; 
        $activo->dir = $request->dir; 
        $activo->email = $request->email; 
        $activo->foto = $request->foto;   
        $activo->genero = $request->genero;    
        $activo->save(); 
 
        return redirect('/Doctor');
    }
    public function updatePaciente(Request $request)
    { 
        $activo = User::findOrFail($request->id);
        $activo->name = $request->name; 
        $activo->iddepartamento = $request->iddepartamento; 
        $activo->idprovincia = $request->idprovincia; 
        $activo->ci = $request->ci; 
        $activo->telefono = $request->telefono;  
        $activo->fechanacimiento = $request->fechanacimiento;  
        $activo->dir = $request->dir; 
        $activo->email = $request->email; 
        $activo->foto = $request->foto; 

        $activo->zona = $request->zona;       
        $activo->red = $request->red;       
        $activo->idioma = $request->idioma;       
        $activo->lengua = $request->lengua;       
        $activo->autoidentificacion = $request->autoidentificacion;       
        $activo->alfabeta = $request->alfabeta;       
        $activo->estudios = $request->estudios;       
        $activo->nivelanios = $request->nivelanios;       
        $activo->estadocivil = $request->estadocivil;       
        $activo->vivesola = $request->vivesola;       
        $activo->controlprenatalen = $request->controlprenatalen;       
        $activo->partoen = $request->partoen;       
        $activo->cip = $request->cip;       
        $activo->numhisclinico = $request->numhisclinico;       
        
        $activo->save(); 
         
        return redirect('/Paciente');
    }
    public function updateEnfermera(Request $request)
    { 
        $activo = User::findOrFail($request->id);
        $activo->name = $request->name; 
        $activo->iddepartamento = $request->iddepartamento; 
        $activo->idprovincia = $request->idprovincia; 
        $activo->ci = $request->ci; 
        $activo->telefono = $request->telefono; 
        $activo->telfamiliar = $request->telfamiliar; 
        $activo->fechanacimiento = $request->fechanacimiento; 
        $activo->matricula = $request->matricula; 
        $activo->dir = $request->dir; 
        $activo->email = $request->email; 
        $activo->foto = $request->foto;   
        $activo->genero = $request->genero;    
        $activo->save(); 
 
        return redirect('/Enfermera');
    }
    public function deletedoctor(Request $request)
    { 
        $activo = User::findOrFail($request->id);
        $activo->activo = 0; 
        $activo->save(); 
 
        return redirect('/Doctor');
    }
    public function deletepaciente(Request $request)
    { 
        $activo = User::findOrFail($request->id);
        $activo->activo = 0; 
        $activo->save(); 
 
        return redirect('/Paciente');
    }
    public function deleteEnfermera(Request $request)
    { 
        $activo = User::findOrFail($request->id);
        $activo->activo = 0; 
        $activo->save(); 
 
        return redirect('/Enfermera');
    }
    public function userin()
    {
        $Rolmenu= Rolmenu::select('menus.idmenu','menus.nommenu','menus.logo')
        ->join("menus","menus.idmenu","=","rolmenus.idmenu")
        ->where('rolmenus.idrol',Auth::user()->idrol) 
        ->orderBy('rolmenus.idmenu')
        ->get();
        foreach($Rolmenu as $menus) 
        { 
            $menus->vistas= MenuVista::select('vistas.*')
            ->join("vistas","vistas.idv","=","menu_vistas.idv")
            ->where('menu_vistas.idmenu',$menus->idmenu) 
            ->orderBy('menu_vistas.idv')
            ->get();
        }
 
       $user= User::select(  
        "users.name",
        "users.id",
        "rols.idrol", 
        "rols.namerol" ) 
        ->join("rols","rols.idrol","=","users.idrol") 
        ->where('users.id',Auth::id())  
        ->first(); 
        return ['user'=>$user,'menus'=> $Rolmenu]; 
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
