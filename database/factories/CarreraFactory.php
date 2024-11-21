<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Carrera;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
{
    protected $model = Carrera::class;
    public function definition()
    {
    
       
        return [
            'nombre_carrera' => $this->faker->unique()->word, // Nombre único
        ];
    }
}
