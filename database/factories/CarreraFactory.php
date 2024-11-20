<?php

namespace Database\Factories;
use App\Models\Carrera;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
{
    protected $model = Carrera::class;
    public function definition()
    {
        return [
         
            'nombre_carrera' => $this->faker->uniqid()->Word  // Nombre único
        ];
    }
}
