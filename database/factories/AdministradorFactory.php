<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;

class AdministradorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = $this->faker->unique()->firstName();
        return [
            'nome_completo' => $firstName . " " . $this->faker->lastName(),
            'login' => $firstName,
            'senha' =>  Hash::make("admin"),
        ];
    }
}
