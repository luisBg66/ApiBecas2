<?php

namespace Database\Factories;
use App\Models\Aseptado;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aseptado>
 */
class AseptadoFactory extends Factory
{
    protected $model = Aseptado::class;
    public function definition(): array
    {
        return [
            'id_estudiante' => Estudiante::factory(), // Relación con `Estudiantes`
        ];
    }
}
