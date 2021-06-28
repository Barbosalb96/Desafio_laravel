<?php

use Illuminate\Database\Seeder;
use App\TipoVeiculo;

class TipoVeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoVeiculo::create([
            'nome' => 'Moto',
        ]);
        TipoVeiculo::create([
            'nome' => 'Carro',
        ]);
        TipoVeiculo::create([
            'nome' => 'Caminhão',
        ]);
    }
}
