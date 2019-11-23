<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Modules\Calendario\Entities\Funcionario::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'user_id' => factory(\Modules\Calendario\Entities\User::class)->create()->id,
        'setor_id' => factory(\Modules\Calendario\Entities\Setor::class)->create()->id
    ];
});
