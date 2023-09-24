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
        ->where('idrol',3)
        ->orderBy('name')
        ->paginate(10);  
        return Inertia::render('Enfermera', [ 
            'lista' =>  $enfermeras
        ]);
    }
    public function listarPaciente(Request $request): Response
    {
        $Pacientes= User::where('activo',1)
        ->where('idrol',4)
        ->orderBy('name')
        ->paginate(10);  
        return Inertia::render('Paciente', [ 
            'lista' =>  $Pacientes
        ]);
    }
    public function listarDoctor(Request $request): Response
    {
        $Pacientes= User::where('activo',1)
        ->where('idrol',2)
        ->orderBy('name')
        ->paginate(10);  
        return Inertia::render('Doctor', [ 
            'lista' =>  $Pacientes
        ]);
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
