<?php

namespace Database\Seeders;

use App\Models\Escolar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Escolar::factory(20)->create();
    }
}
