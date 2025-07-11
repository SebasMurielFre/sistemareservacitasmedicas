<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PacienteFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'dni' => $this->faker->unique()->numerify('##########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2020-01-01'),
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'estado_civil' => $this->faker->randomElement(['Soltero', 'Casado', 'Unión de hecho', 'Divorciado', 'Viudo']),
            'celular' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'direccion' => $this->faker->address,
            'grupo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'contacto_emergencia' => $this->faker->phoneNumber,
            'enfermedades' => $this->faker->words(3, true),
            'alergias' => $this->faker->words(3, true),
            'antecedentes' => $this->faker->words(3, true),
            'observaciones' => $this->faker->words(3, true),
        ];
    }
}
