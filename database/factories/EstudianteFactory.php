<?php

namespace Database\Factories;
use App\Models\Estudiante;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    protected $model = Estudiante::class;

    public function definition()
    {
        return [
            
            'numero_control' => $this->faker->unique()->regexify('[A-Z0-9]{10}'), // ID único
            'nombre' => $this->faker->firstName,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'id_carrera' => Carrera::all()->random()->id, // Relación con `Carreras`
            'correo' => $this->faker->unique()->safeEmail,
        ];
    }
}
