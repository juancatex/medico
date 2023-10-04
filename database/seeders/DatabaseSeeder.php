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
        DB::table('departamentos')->insert(['iddepartamento'=>1,'nomdepartamento'=>'La Paz','abrvdep'=>'LP']);
        DB::table('departamentos')->insert(['iddepartamento'=>2,'nomdepartamento'=>'Cochabamba','abrvdep'=>'CB']);
        DB::table('departamentos')->insert(['iddepartamento'=>3,'nomdepartamento'=>'Chuquisaca','abrvdep'=>'CH']); 
        DB::table('departamentos')->insert(['iddepartamento'=>4,'nomdepartamento'=>'Oruro','abrvdep'=>'OR']);
        DB::table('departamentos')->insert(['iddepartamento'=>5,'nomdepartamento'=>'Potosí','abrvdep'=>'PT']);
        DB::table('departamentos')->insert(['iddepartamento'=>6,'nomdepartamento'=>'Tarija','abrvdep'=>'TJ']);
        DB::table('departamentos')->insert(['iddepartamento'=>7,'nomdepartamento'=>'Santa Cruz','abrvdep'=>'SC']);
        DB::table('departamentos')->insert(['iddepartamento'=>8,'nomdepartamento'=>'Beni','abrvdep'=>'BN']);
        DB::table('departamentos')->insert(['iddepartamento'=>9,'nomdepartamento'=>'Pando','abrvdep'=>'PD']);

        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Abel Iturralde']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Aroma']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Bautista Saavedra']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Caranavi']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Eliodoro Camacho']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Franz Tamayo']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Gualberto Villarroel']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Ingaví']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Inquisivi']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'General José Manuel Pando']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'José Ramón Loayza']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Larecaja']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Los Andes']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Manco Kapac']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Muñecas']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Nor Yungas']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Omasuyos']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Pacajes']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Pedro Domingo Murillo']);
        DB::table('provincias')->insert(['iddepartamento'=>1,'nomprovincia'=>'Sud Yungas']);

        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Arani']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Arque']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Ayopaya']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Bolívar']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Capinota']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'José Carrasco']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Cercado']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Chapare']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Esteban Arze']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Germán Jordán']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Mizque']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Campero']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Punata']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Quillacollo']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Tapacarí']);
        DB::table('provincias')->insert(['iddepartamento'=>2,'nomprovincia'=>'Tiraque']);

        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Belisario Boeto']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Hernando Siles']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Jaime Zudáñez']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Juana Azurduy de Padilla']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Luis Calvo']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Nor Cinti']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Oropeza']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Sud Cinti']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Tomina']);
        DB::table('provincias')->insert(['iddepartamento'=>3,'nomprovincia'=>'Yamparáez']);
 
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Sabaya']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Carangas']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Cercado']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Eduardo Avaroa']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Ladislao Cabrera']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Litoral de Atacama']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Nor Carangas']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Pantaleón Dalence']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Poopó']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Mejillones']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Sajama']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'San Pedro de Totora']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Saucarí']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Sebastián Pagador']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Sud Carangas']);
        DB::table('provincias')->insert(['iddepartamento'=>4,'nomprovincia'=>'Tomás Barrón']);

        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Alonso de Ibáñez']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Antonio Quijarro']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Bernardino Bilbao']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Charcas']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Chayanta']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Cornelio Saavedra']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Daniel Campos']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Enrique Baldivieso']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'José María Linares']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Modesto Omiste']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Nor Chichas']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Nor Lípez']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Rafael Bustillo']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Sud Chichas']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Sud Lípez']);
        DB::table('provincias')->insert(['iddepartamento'=>5,'nomprovincia'=>'Tomás Frías']);

        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'Aniceto Arce']);
        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'Burdet OConnor']);
        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'Cercado']);
        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'Eustaquio Méndez']);
        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'Gran Chaco']);
        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'José María Avilés']);
        DB::table('provincias')->insert(['iddepartamento'=>6,'nomprovincia'=>'Lago Titicaca']);

        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Andrés Ibáñez']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Ángel Sandóval']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Chiquitos']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Cordillera']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Florida']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Germán Busch']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Guarayos']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Ichilo']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Warnes']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Velasco']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Caballero']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Ñuflo de Chaves']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Obispo Santistevan']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Sara']);
        DB::table('provincias')->insert(['iddepartamento'=>7,'nomprovincia'=>'Vallegrande']);

        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Cercado']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Iténez']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'General José Ballivián']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Segurola']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Mamoré']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Marbán']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Moxos']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Vaca Díez']);
        DB::table('provincias')->insert(['iddepartamento'=>8,'nomprovincia'=>'Yacuma']);

        DB::table('provincias')->insert(['iddepartamento'=>9,'nomprovincia'=>'Abuná']);
        DB::table('provincias')->insert(['iddepartamento'=>9,'nomprovincia'=>'General Federico Román']);
        DB::table('provincias')->insert(['iddepartamento'=>9,'nomprovincia'=>'Madre de Dios']);
        DB::table('provincias')->insert(['iddepartamento'=>9,'nomprovincia'=>'Manuripi']);
        DB::table('provincias')->insert(['iddepartamento'=>9,'nomprovincia'=>'Nicolás Suárez']);
      
        DB::table('rols')->insert(['idrol'=>1,'namerol'=>'Administrador','descripcionrol'=>'Administrador']);
        DB::table('rols')->insert(['idrol'=>2,'namerol'=>'Doctor','descripcionrol'=>'Doctor']);
        DB::table('rols')->insert(['idrol'=>3,'namerol'=>'Enfermera','descripcionrol'=>'Enfermera']); 
        DB::table('rols')->insert(['idrol'=>4,'namerol'=>'Paciente','descripcionrol'=>'Paciente']); 

        DB::table('menus')->insert(['idmenu'=>1,'nommenu'=>'Usuarios','logo'=>'fa fa-users']); 
        DB::table('menus')->insert(['idmenu'=>2,'nommenu'=>'Antecedentes','logo'=>'fa fa-list']);
        DB::table('menus')->insert(['idmenu'=>3,'nommenu'=>'Gestacion Actual','logo'=>'fa fa-female']);
        DB::table('menus')->insert(['idmenu'=>4,'nommenu'=>'Control Prenatal','logo'=>'fa fa-edit']); 
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
        DB::table('vistas')->insert(['idv'=>4,'nomvista'=>'Antecedentes','nomvue'=>'Antecedentes','ruta'=>'Antecedentes']);

        DB::table('menu_vistas')->insert(['idmenu'=>1,'idv'=>1]);
        DB::table('menu_vistas')->insert(['idmenu'=>1,'idv'=>2]);
        DB::table('menu_vistas')->insert(['idmenu'=>1,'idv'=>3]);

        DB::table('menu_vistas')->insert(['idmenu'=>2,'idv'=>4]); 
 

        $user = new \App\Models\User(); 
        $user->name = 'Juan Perez Camacho'; 
        $user->idrol = 1; 
        $user->iddepartamento = 1; 
        $user->idprovincia = 19; 
        $user->ci = 83017919; 
        $user->genero = 'M'; 
        $user->fechanacimiento = '1989-01-29'; 
        $user->email = 'ddd@hotmail.com';
        $user->password = bcrypt('ddd');
        $user->save();
 
    }
}
