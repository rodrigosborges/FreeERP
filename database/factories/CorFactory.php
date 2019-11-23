<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Modules\Calendario\Entities\Cor::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'codigo' => $faker->randomNumber(6)
    ];
});
