<?php

namespace Database\Factories;
use App\Models\Requerimientos;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requeremientos>
 */
class RequeremientosFactory extends Factory
{

    public function definition()
    {
        return [
            'id_estudiante' => Estudiante::factory(), // Relación con `Estudiantes`
            'nombre_requerimiento' => $this->faker->sentence(3),
        ];
    }
}
