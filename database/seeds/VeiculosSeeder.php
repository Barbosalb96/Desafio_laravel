<?php

use Illuminate\Database\Seeder;
use App\Veiculo;

class VeiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Veiculo::class,10)->create();
    }
}
