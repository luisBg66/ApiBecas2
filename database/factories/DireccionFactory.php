<?php

namespace Database\Factories;
use App\Models\Direccion;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direcion>
 */
class DireccionFactory extends Factory
{
    protected $model = Direccion::class;

    public function definition()
    {
        return [
            'id_estudiante' => Estudiante::all()->random()->id, // Relación con `Estudiantes`
            'municipio' => $this->faker->city,
            'colonia' => $this->faker->streetName,
            'calle' => $this->faker->streetAddress,
            'numero' => $this->faker->randomNumber(3),
        ];
    }
}
