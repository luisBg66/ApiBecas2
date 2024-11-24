<?php

namespace Database\Factories;
use App\Models\Economia;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Economia>
 */
class EconomiaFactory extends Factory
{
    protected $model = Economia::class;
    public function definition()
    {
        return [
            'id_estudiante' => Estudiante::all()->random()->id, // Relación con `Estudiantes`
            'ingresos' => $this->faker->randomFloat(2, 1000, 50000), // Valores entre 1000 y 50000
        ];
    }
}
