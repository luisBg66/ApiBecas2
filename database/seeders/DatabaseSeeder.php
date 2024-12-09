<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrera;


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

        $this->call(RolesAndPermissionsSeeder::class);
/*
        Carrera::factory(5)->create(); // Genera 5 carreras ficticias

        $this->call(
            [ 
            EstudianteSeeder::class,
            DireccionSeeder::class,
            EconomiaSeeder::class,
            SocialSeeder::class,
            EscolarSeeder::class,
           
        ]);
        */
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
