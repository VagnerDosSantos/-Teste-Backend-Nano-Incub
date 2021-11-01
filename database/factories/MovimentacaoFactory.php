<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Funcionario;
use App\Models\Administrador;
use Carbon\Carbon;
class MovimentacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipo = ['entrada', 'saida'];

        return [
            'tipo_movimentacao' => $tipo[rand(0, 1)],
            'valor' => $this->faker->randomFloat(2, 1, 1000),
            'observacao' => $this->faker->sentence(),
            'funcionario_id' => Funcionario::inRandomOrder()->first()->id,
            'administrador_id' => Administrador::inRandomOrder()->first()->id,
            'created_at' => Carbon::today()->subDays(rand(0, 730))
        ];
    }
}
