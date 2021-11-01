<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;
use Faker;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        Administrador::insert([
            'nome_completo' => $faker->firstName() . " " . $faker->lastName(),
            'login' => "admin",
            'senha' =>  Hash::make("admin"),
        ]);
    }
}
