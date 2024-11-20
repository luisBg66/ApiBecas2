<?php

namespace Database\Factories;
use App\Models\Escolar;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Escolar>
 */
class EscolarFactory extends Factory
{
    protected $model = Escolar::class;
    public function definition(): array
    {
        return [
            'id_estudiante' => Estudiante::factory(), // Relación con `Estudiantes`
            'promedio' => $this->faker->randomFloat(2, 5.0, 10.0), // Valores entre 5.0 y 10.0
            'materia_en_repeticion' => $this->faker->boolean,
        ];
    }
}
