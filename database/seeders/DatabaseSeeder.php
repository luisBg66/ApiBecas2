<?php

namespace Database\Seeders;
use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Social;
use App\Models\Direccion;
use App\Models\Economia;
use App\Models\Escolar;
use App\Models\Requerimiento;
use App\Models\Aceptado;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // User::factory(10)->create();

    
  /*  $this->call([
            CarrerasSeeder::class,
            EstudiantesSeeder::class,
            DireccionesSeeder::class,
            EconomiaSeeder::class,
            SocialSeeder::class,
            EscolarSeeder::class,

        ]); */

        $this->call(
            [ RolesAndPermissionsSeeder::class,
            CarrerasSeeder::class,
            EstudiantesSeeder::class,
            DireccionesSeeder::class,
            EconomiaSeeder::class,
            SocialSeeder::class,
            EscolarSeeder::class,
           
        ]);

        User::factory()->create([
            'nombre'=>'Milly',
            'apellido_paterno'=>'castañeda',
            'apellido_materno'=>'Alcantar',
            'rango'=>'Presisndete',
            'email'=>'milly12@asmin.com',
         ])->assignRole('Precidente');
            
    
         User::factory()->create([
            'nombre'=>'Luis',
            'apellido_paterno'=>'cassd',
            'apellido_materno'=>'dsdsds',
            'rango'=>'Bice',
            'email'=>'Luis12@asmin.com',
         ])->assignRole('usurcomite');
    
         User::factory(29)->create()->each(function ($user) {
            $user->assignRole('Usuario');
        });      

    }
}
