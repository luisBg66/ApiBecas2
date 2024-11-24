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
        User::factory(10)->create();

    /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',

        ]); */
  /*  $this->call([
            CarrerasSeeder::class,
            EstudiantesSeeder::class,
            DireccionesSeeder::class,
            EconomiaSeeder::class,
            SocialSeeder::class,
            EscolarSeeder::class,

        ]); */

        $this->call([
            CarrerasSeeder::class,
            EstudiantesSeeder::class,
            DireccionesSeeder::class,
            EconomiaSeeder::class,
            SocialSeeder::class,
            EscolarSeeder::class,

        ]);
    }
}
