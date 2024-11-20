<?php

namespace Database\Factories;
use App\Models\Social;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Social>
 */
class SocialFactory extends Factory
{
    protected $model = Social::class;
    public function definition()
    {
        return [
            'id_estudiante' => Estudiante::factory(), // Relación con `Estudiantes`
            'integrantes_familia' => $this->faker->numberBetween(1, 10),
        ];
    }
}
