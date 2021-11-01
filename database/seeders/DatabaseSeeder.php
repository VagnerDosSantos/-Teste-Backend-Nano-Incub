<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Administrador, Funcionario, Movimentacao};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdministradorSeeder::class,
            FuncionarioSeeder::class,
        ]);

        Administrador::factory(3)->create();
        Funcionario::factory(100)->create();
        Movimentacao::factory(2400)->create();

        $funcionarios = Funcionario::all();

        foreach ($funcionarios as $funcionario) {
            $entrada = $funcionario->extrato->where('tipo_movimentacao', 'entrada')->sum('valor');
            $saida = $funcionario->extrato->where('tipo_movimentacao', 'saida')->sum('valor');
            $saldo = $entrada - $saida;
            $funcionario->saldo_atual = $saldo < 0 ? 0.00 : $saldo;
            $funcionario->save();
        }
    }
}
