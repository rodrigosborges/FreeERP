<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Modules\Calendario\Entities\Evento::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'data_inicio' => '2019-12-31 18:00:00',
        'data_fim' => '2019-12-31 19:00:00',
        'agenda_id' => factory(\Modules\Calendario\Entities\Agenda::class)->create()->id
    ];
});
