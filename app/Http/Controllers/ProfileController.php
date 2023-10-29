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
use App\Models\GestacionActual;
use App\Models\Antecedente;
use App\Models\ControlPrenatal;
use Illuminate\Support\Facades\DB;
use PDF; 
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function dashboard(): Response
    {
        $raw=DB::raw('DATE_FORMAT(users.fechanacimiento, "%d  %m  %y") as fechanacimientoo');   
        $pacientes= User::select('users.*','departamentos.nomdepartamento','provincias.nomprovincia', $raw)
        ->join("departamentos","departamentos.iddepartamento","=","users.iddepartamento")
        ->join("provincias","provincias.idprovincia","=","users.idprovincia")
        ->where('users.idrol',4) 
        ->where('users.id',Auth::id()) 
        ->where('users.activo',1) 
        ->with("getmayor")
        ->first(); 
        // Auth::id()
        $raw2=DB::raw('DATE_FORMAT(antecedentes.finembarazoanterior, "%d  %m  %y") as finembarazoanteriorr');  
        $ante=Antecedente::select('antecedentes.*',$raw2)->where('iduser', Auth::id())->first(); 

        $raw3=DB::raw('DATE_FORMAT(gestacion_actuals.fppdate, "%d  %m  %y") as fppdatee');  
        $raw4=DB::raw('DATE_FORMAT(gestacion_actuals.fumdate, "%d  %m  %y") as fumdatee');  
        $gest=GestacionActual::select('gestacion_actuals.*',$raw3,$raw4)->where('iduser', Auth::id())->first();

        $raw5=DB::raw('DATE_FORMAT(control_prenatals.asisfecha, "%d  %m  %y") as asisfechaa');  
        $raw6=DB::raw('DATE_FORMAT(control_prenatals.proximacita, "%d  %m  %y") as proximacitaa');  
        $controles=ControlPrenatal::select('control_prenatals.*','users.name','users.matricula',$raw5,$raw6) 
        ->leftJoin('users', function($join) {
         $join->on('users.id', '=', 'control_prenatals.responsable')->where('users.activo',1);
       })
       ->where('control_prenatals.iduser', Auth::id())
       ->orderBy('control_prenatals.idprenat', 'asc')->get();   
       
       $embarazopla=[
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',1)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',2)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',3)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',4)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',5)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',6)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',7)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',8)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',8)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',10)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',11)->count(), 
       Antecedente::where('embarazoplaneado',0)->whereRaw('MONTH(fecha)=?',12)->count()];
       $embarazonopla=[
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',1)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',2)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',3)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',4)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',5)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',6)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',7)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',8)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',8)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',10)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',11)->count(), 
       Antecedente::where('embarazoplaneado',1)->whereRaw('MONTH(fecha)=?',12)->count()];

       $metodos=[
        Antecedente::where('fracasometodo',0)->count(),
        Antecedente::where('fracasometodo',1)->count(),
        Antecedente::where('fracasometodo',2)->count(),
        Antecedente::where('fracasometodo',3)->count(),
        Antecedente::where('fracasometodo',4)->count(),
        Antecedente::where('fracasometodo',5)->count()
       ];
       
       $totaldoctor=User::where('users.idrol',2)  
       ->where('users.activo',1)->count(); 
       $totalenfer=User::where('users.idrol',3)  
       ->where('users.activo',1)->count(); 
       $totalpaci=User::where('users.idrol',4)  
       ->where('users.activo',1)->count(); 

        $now = Carbon::now(); 
        return Inertia::render('Dashboard',[
            'time'=>$now->format('A'),
            'user'=>Auth::user(),
            'paciente' =>  $pacientes, 
            'ante' =>  $ante, 
            'gest' =>  $gest, 
            'controles' =>  $controles,
            'embarazopla' =>  $embarazopla,
            'embarazonopla' =>  $embarazonopla,
            'metodos' =>  $metodos,
            'totaldoctor' =>  $totaldoctor,
            'totalenfer' =>  $totalenfer,
            'totalpaci' =>  $totalpaci,
        ]);
    }
    public function seguridad(Request $request): Response
    {
        return Inertia::render('Seguridad', [
            'user' => Auth::user(), 
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
        $fechaactual = date('Y-m-d'); 
        $fechamin = strtotime ('-1 year' , strtotime($fechaactual));  
        $fechamin = date ('Y-m-d',$fechamin);
        $fechamax = strtotime ('-40 year' , strtotime($fechaactual));  
        $fechamax = date ('Y-m-d',$fechamax);
        return Inertia::render('Enfermera', [ 
            'lista' =>  $enfermeras,
            'dep' =>  $dep,
            'prov' =>  $prov,
            'datemin' =>   $fechamin,
            'datemax' => $fechamax,
        ]);

    }
    public function listarPaciente(Request $request): Response
    {
        $raw=DB::raw('DATE_FORMAT(users.created_at,"%Y") as gestion');  
        $pacientes= User::select('users.*',$raw)->where('idrol',4) ;
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('name')->orderBy('gestion')->paginate(5); 
        
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
        $fechaactual = date('Y-m-d'); 
        $fechamin = strtotime ('-9 year' , strtotime($fechaactual));  
        $fechamin = date ('Y-m-d',$fechamin);
        $fechamax = strtotime ('-55 year' , strtotime($fechaactual));  
        $fechamax = date ('Y-m-d',$fechamax);
        return Inertia::render('Paciente', [ 
            'lista' =>  $pacientes,
            'dep' =>  $dep,
            'prov' =>  $prov,
            'autoid' =>  $autoidentificacion,
            'datemin' =>   $fechamin,
            'datemax' => $fechamax,
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
    public function listarPacienteGestacionActual(Request $request): Response
    {
          
        $pacientes= User::where('activo',1)
        ->where('idrol',4) ;
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('name')->paginate(5); 
         
        return Inertia::render('GestacionActual', [ 
            'lista' =>  $pacientes, 
        ]);
    }
    public function listarPacienteControlprenatal(Request $request): Response
    {  

        $pacientes= User::select('users.*','control_prenatals.responsable')
        ->leftJoin('control_prenatals', function($join) {
            $join->on('control_prenatals.iduser', '=', 'users.id')->where('control_prenatals.asisfecha',date("Y-m-d"));
          })
        ->where('users.activo',1)
        ->where('users.idrol',4) ;
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('users.name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('users.name')->with("getmayor")->with("getante")->with("getgest")->paginate(5); 
         
        return Inertia::render('ControlPrenatal', [ 
            'lista' =>  $pacientes, 
        ]);
    }
    public function listarPacienteCarnetperinatal(Request $request): Response
    {
        $raw=DB::raw('DATE_FORMAT(users.fechanacimiento, "%d  %m  %y") as fechanacimientoo');   
        $pacientes= User::select('users.*','departamentos.nomdepartamento','provincias.nomprovincia', $raw)
        ->join("departamentos","departamentos.iddepartamento","=","users.iddepartamento")
        ->join("provincias","provincias.idprovincia","=","users.idprovincia")
        ->where('users.idrol',4) 
        ->where('users.id',Auth::id()) 
        ->where('users.activo',1) 
        ->first(); 
        // Auth::id()
        $raw2=DB::raw('DATE_FORMAT(antecedentes.finembarazoanterior, "%d  %m  %y") as finembarazoanteriorr');  
        $ante=Antecedente::select('antecedentes.*',$raw2)->where('iduser', Auth::id())->first(); 

        $raw3=DB::raw('DATE_FORMAT(gestacion_actuals.fppdate, "%d  %m  %y") as fppdatee');  
        $raw4=DB::raw('DATE_FORMAT(gestacion_actuals.fumdate, "%d  %m  %y") as fumdatee');  
        $gest=GestacionActual::select('gestacion_actuals.*',$raw3,$raw4)->where('iduser', Auth::id())->first();

        $raw5=DB::raw('DATE_FORMAT(control_prenatals.asisfecha, "%d  %m  %y") as asisfechaa');  
        $raw6=DB::raw('DATE_FORMAT(control_prenatals.proximacita, "%d  %m  %y") as proximacitaa');  
        $controles=ControlPrenatal::select('control_prenatals.*','users.name','users.matricula',$raw5,$raw6) 
        ->leftJoin('users', function($join) {
         $join->on('users.id', '=', 'control_prenatals.responsable')->where('users.activo',1);
       })
       ->where('control_prenatals.iduser', Auth::id())
       ->orderBy('control_prenatals.idprenat', 'asc')->get();   

        return Inertia::render('CarnetPerinatal', [ 
            'paciente' =>  $pacientes, 
            'ante' =>  $ante, 
            'gest' =>  $gest, 
            'controles' =>  $controles, 
        ]);
    }
    public function listarPacienteCarnetperinatalLista(Request $request): Response
    {
          
        $pacientes= User::where('activo',1)
        ->where('idrol',4) ;
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('name')->paginate(5); 
         
        return Inertia::render('CarnetPerinatalList', [ 
            'lista' =>  $pacientes, 
        ]);
    }
    public function pdflistadoin(Request $request)
    {
        
       $raw=DB::raw('DATE_FORMAT(users.fechanacimiento, "%d  %m  %y") as fechanacimientoo');   
        $pacientes= User::select('users.*','departamentos.nomdepartamento','provincias.nomprovincia', $raw)
        ->join("departamentos","departamentos.iddepartamento","=","users.iddepartamento")
        ->join("provincias","provincias.idprovincia","=","users.idprovincia")
        ->where('users.idrol',4) 
        ->where('users.id',$request->id) 
        ->where('users.activo',1) 
        ->first(); 
        // Auth::id()
        $raw2=DB::raw('DATE_FORMAT(antecedentes.finembarazoanterior, "%d  %m  %y") as finembarazoanteriorr');  
        $ante=Antecedente::select('antecedentes.*',$raw2)->where('iduser',$request->id)->first(); 

        $raw3=DB::raw('DATE_FORMAT(gestacion_actuals.fppdate, "%d  %m  %y") as fppdatee');  
        $raw4=DB::raw('DATE_FORMAT(gestacion_actuals.fumdate, "%d  %m  %y") as fumdatee');  
        $gest=GestacionActual::select('gestacion_actuals.*',$raw3,$raw4)->where('iduser',$request->id)->first();

        $raw5=DB::raw('DATE_FORMAT(control_prenatals.asisfecha, "%d  %m  %y") as asisfechaa');  
        $raw6=DB::raw('DATE_FORMAT(control_prenatals.proximacita, "%d  %m  %y") as proximacitaa');  
        $controles=ControlPrenatal::select('control_prenatals.*','users.name','users.matricula',$raw5,$raw6) 
        ->leftJoin('users', function($join) {
         $join->on('users.id', '=', 'control_prenatals.responsable')->where('users.activo',1);
       })
       ->where('control_prenatals.iduser', $request->id)
       ->orderBy('control_prenatals.idprenat', 'asc')->get();   



        return   [ 
            'paciente' =>  $pacientes, 
            'ante' =>  $ante, 
            'gest' =>  $gest, 
            'controles' =>  $controles, 
        ];
    }
   
    public function listarPacienteControlprenataltrat(Request $request): Response
    {
          
        $pacientes= User::select('users.*','control_prenatals.idprenat','control_prenatals.responsable')
        ->join("control_prenatals","control_prenatals.iduser","=","users.id")
        ->where('users.activo',1)
        ->where('users.idrol',4)
        ->where('control_prenatals.asisfecha',date("Y-m-d"));
        if(!empty($request->search)){ 
            $pacientes=$pacientes->where('name','like',"%$request->search%") ; 
        }
        $pacientes=$pacientes->orderBy('name')->paginate(5); 
         
        return Inertia::render('ControlPrenatalTrat', [ 
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
            'telefono' => 'required|numeric|max:99999999',    
            'telfamiliar' => 'required|numeric|max:99999999',    
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
        $fechain = date('Y-m-d',strtotime($request->fechanacimiento. " 00:00:00")); 
        $fechaactual = date('Y-m-d'); 
        $fechamin = strtotime ('-55 year' , strtotime($fechaactual));  
        $fechamin = date ('Y-m-d',$fechamin);
        $fechamax = strtotime ('-9 year' , strtotime($fechaactual));  
        $fechamax = date ('Y-m-d',$fechamax);


        if (!(($fechain >= $fechamin) && ($fechain <= $fechamax))){
            
            return back()->withErrors([
                'fechanacimiento' => 'Error en la fecha de nacimiento'
            ]);
        }
        $request->validate([ 
            'name' => 'required|string|max:255',  
            'dir' => 'required',  
            'iddepartamento' => 'required|numeric', 
            'idprovincia' => 'required|numeric', 
            'telefono' => 'required|numeric|max:99999999',
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
            'telefono' => 'required|numeric|max:99999999',    
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
    public function resetpassDoc(Request $request)
    { 
        $activo = User::findOrFail($request->id);        
        $activo->password =  bcrypt($activo->cip);
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
    public function resetpassPaciente(Request $request)
    { 
        $activo = User::findOrFail($request->id);        
        $activo->password =  bcrypt($activo->cip);
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
    public function resetpassEnf(Request $request)
    { 
        $activo = User::findOrFail($request->id);        
        $activo->password =  bcrypt($activo->cip);
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
        $activo->email =null; 
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
        // if ( Auth::user()->password!=bcrypt($request->passactual)){ 
        if (\Hash::check($request->passactual, Auth::user()->password)){ 
            $request->validate([    
                'password' => 'required',
                "passwordConfirm" => "required|same:password",
            ]);
    
            $activo = User::findOrFail($request->id); 
            $activo->password =  bcrypt($request->password);  
            $activo->save(); 
            return redirect('/seguridad');
        }else{
            return back()->withErrors([
                'passactual' => 'La contraseña actual no es la correcta.'
            ]);
        }
        
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

    public function rep1(Request $request)
    {
        DB::statement("SET lc_time_names = 'es_ES'");
        $raw=DB::raw('DATE_FORMAT(users.created_at, "%M") as mess');   
        $pacientes= User::select('users.*',$raw)->where('activo',1)
        ->where('idrol',4)
        ->orderBy('mess')
        ->orderBy('name')
        ->get(); 
        $pdf = PDF::loadView('Reportes/vistas/reporte1', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte1', [ 
            'pdf' =>  $datopdf
        ]);
    }
    public function rep2(Request $request)
    {
        DB::statement("SET lc_time_names = 'es_ES'"); 
        $pacientes= User::select('users.*')->where('activo',1)
        ->where('idrol',4) 
        ->orderBy('name')
        ->get(); 
        $pdf = PDF::loadView('Reportes/vistas/reporte2', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte2', [ 
            'pdf' =>  $datopdf
        ]);
    }
    public function rep3(Request $request)
    {
        DB::statement("SET lc_time_names = 'es_ES'"); 
        $pacientes= User::select('users.*','antecedentes.embarazoplaneado')
        ->join("antecedentes","antecedentes.iduser","=","users.id")
        ->where('activo',1)
        ->where('idrol',4)
        ->whereNotNull('antecedentes.embarazoplaneado') 
        ->orderBy('name')
        ->get(); 
        $pdf = PDF::loadView('Reportes/vistas/reporte3', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte3', [ 
            'pdf' =>  $datopdf
        ]);
    }
    public function rep4(Request $request)
    {  
        $pacientes= User::select('users.*')->where('activo',1)
        ->where('idrol',4) 
        ->orderBy('name')
        ->get(); 
        $pdf = PDF::loadView('Reportes/vistas/reporte4', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte4', [ 
            'pdf' =>  $datopdf
        ]);
    }
    public function rep5(Request $request)
    {
        DB::statement("SET lc_time_names = 'es_ES'"); 
        $pacientesij= User::select('antecedentes.fracasometodo',DB::raw('count(*) as total'))
        ->join("antecedentes","antecedentes.iduser","=","users.id")
        ->where('activo',1)
        ->where('idrol',4)
        ->whereNotNull('antecedentes.fracasometodo') 
        ->groupBy('antecedentes.fracasometodo') 
        ->get(); 

        $mayor=0; 
        $fracasometodo=0; 
        foreach ($pacientesij as $data) {
           if($data->total > $mayor){
             $mayor=$data->total; 
             $fracasometodo=$data->fracasometodo;
           }
        }
        $pacientes= User::select('users.*','antecedentes.fracasometodo')
        ->join("antecedentes","antecedentes.iduser","=","users.id")
        ->where('activo',1)
        ->where('idrol',4)
        ->where('antecedentes.fracasometodo',$fracasometodo)
        ->whereNotNull('antecedentes.fracasometodo') 
        ->orderBy('name')
        ->get(); 

        $pdf = PDF::loadView('Reportes/vistas/reporte5', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte5', [ 
            'pdf' =>  $datopdf
        ]);
    }
    public function rep6(Request $request)
    {
        DB::statement("SET lc_time_names = 'es_ES'");  
        $pacientes= User::select('users.*','antecedentes.vih')
        ->join("antecedentes","antecedentes.iduser","=","users.id")
        ->where('activo',1)
        ->where('idrol',4)
        ->where('antecedentes.vih',1)
        ->whereNotNull('antecedentes.vih') 
        ->orderBy('name')
        ->get(); 

        $pdf = PDF::loadView('Reportes/vistas/reporte6', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte6', [ 
            'pdf' =>  $datopdf
        ]);
    }
    public function rep7(Request $request)
    {  
        $pacientes= User::select('users.*')->where('activo',1)
        ->where('idrol',4) 
        ->orderBy('name')
        ->get(); 
        $pdf = PDF::loadView('Reportes/vistas/reporte7', ['data'=>$pacientes]); 
        $datopdf=base64_encode($pdf->output());
        return Inertia::render('Reportes/Reporte7', [ 
            'pdf' =>  $datopdf
        ]);
    }
}
