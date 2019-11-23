<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Modules\Calendario\Entities\Agenda::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'descricao' => $faker->text,
        'cor_id' => factory(\Modules\Calendario\Entities\Cor::class)->create()->id,
        'funcionario_id' => factory(\Modules\Calendario\Entities\Funcionario::class)->create()->id
    ];
});
