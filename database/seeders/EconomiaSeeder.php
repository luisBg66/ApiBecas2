<?php

namespace Database\Seeders;

use App\Models\Economia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EconomiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Economia::factory()->count(20)->create();
    }
}
