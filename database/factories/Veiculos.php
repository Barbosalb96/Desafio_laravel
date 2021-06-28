<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Veiculo;
use Faker\Generator as Faker;

$factory->define(Veiculo::class, function (Faker $faker) {

    return [
        'modelo' => $faker->name(),
        'marca' => $faker->name(),
        'versao' => $faker->name(),
        'id_tipo_veiculo' => $faker->numberBetween(1, 3),
        'id_user' => $faker->numberBetween(1, 2),
        'ano' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'descricao' => $faker->text(140),
        'updated_at' => \Carbon\Carbon::now(),
        'created_at' => \Carbon\Carbon::now()
    ];
});
