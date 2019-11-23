<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Modules\Calendario\Entities\Setor::class, function (Faker $faker) {
    return [
        'sigla' => $faker->lexify('???'),
        'nome' => $faker->name,
        'user_id' => factory(\Modules\Calendario\Entities\User::class)->create()->id
    ];
});
