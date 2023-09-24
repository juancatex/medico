<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('rols')->insert(['idrol'=>1,'namerol'=>'Administrador','descripcionrol'=>'Administrador']);
        DB::table('rols')->insert(['idrol'=>2,'namerol'=>'Doctor','descripcionrol'=>'Doctor']);
        DB::table('rols')->insert(['idrol'=>3,'namerol'=>'Enfermera','descripcionrol'=>'Enfermera']); 
        DB::table('rols')->insert(['idrol'=>4,'namerol'=>'Paciente','descripcionrol'=>'Paciente']); 

        DB::table('menus')->insert(['idmenu'=>1,'nommenu'=>'Usuarios','logo'=>'fa fa-users']); 
        DB::table('menus')->insert(['idmenu'=>2,'nommenu'=>'Control Prenatal','logo'=>'fa fa-edit']);
        DB::table('menus')->insert(['idmenu'=>3,'nommenu'=>'Gestacion Actual','logo'=>'fa fa-female']);
        DB::table('menus')->insert(['idmenu'=>4,'nommenu'=>'Antecedentes','logo'=>'fa fa-list']);
        DB::table('menus')->insert(['idmenu'=>5,'nommenu'=>'Carnet Perinatal','logo'=>'fa fa-calendar-check']);
        DB::table('menus')->insert(['idmenu'=>6,'nommenu'=>'Reportes','logo'=>'fa fa-flag']);

        DB::table('rolmenus')->insert(['idrol'=>1,'idmenu'=>1]);
        DB::table('rolmenus')->insert(['idrol'=>1,'idmenu'=>2]);
        DB::table('rolmenus')->insert(['idrol'=>1,'idmenu'=>3]);
        DB::table('rolmenus')->insert(['idrol'=>1,'idmenu'=>4]);
        DB::table('rolmenus')->insert(['idrol'=>1,'idmenu'=>5]);
        DB::table('rolmenus')->insert(['idrol'=>1,'idmenu'=>6]);

        DB::table('vistas')->insert(['idv'=>1,'nomvista'=>'Enfermeras','nomvue'=>'Enfermera','ruta'=>'Enfermeras']);
        DB::table('vistas')->insert(['idv'=>2,'nomvista'=>'Pacientes','nomvue'=>'Paciente','ruta'=>'Pacientes']);
        DB::table('vistas')->insert(['idv'=>3,'nomvista'=>'Doctores','nomvue'=>'Doctor','ruta'=>'Doctores']);

        DB::table('menu_vistas')->insert(['idmenu'=>1,'idv'=>1]);
        DB::table('menu_vistas')->insert(['idmenu'=>1,'idv'=>2]);
        DB::table('menu_vistas')->insert(['idmenu'=>1,'idv'=>3]);

        
 

        $user = new \App\Models\User(); 
        $user->name = 'Juan Perez Camacho'; 
        $user->idrol = 1; 
        $user->email = 'ddd@hotmail.com';
        $user->password = bcrypt('ddd');
        $user->save();
    }
}
