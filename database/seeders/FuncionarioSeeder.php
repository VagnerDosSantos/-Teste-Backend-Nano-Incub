<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Hash;
use Faker;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Funcionario::insert([
            'nome_completo' => $faker->unique(false, 100)->firstName() . ' ' . $faker->lastName(),
            'login' => 'funcionario',
            'senha' => Hash::make('funcionario'),
            'administrador_id' => 1,
        ]);
    }
}
