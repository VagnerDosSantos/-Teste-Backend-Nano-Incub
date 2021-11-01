<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Administrador, Funcionario};
use Illuminate\Support\Facades\Hash;

class FuncionarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Funcionario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = $this->faker->unique()->firstName();
        return [
            'nome_completo' => $firstName . ' ' . $this->faker->lastName(),
            'login' => $firstName,
            'senha' => Hash::make("funcionario"),
            'administrador_id' => Administrador::inRandomOrder()->first()->id,
        ];
    }
}
