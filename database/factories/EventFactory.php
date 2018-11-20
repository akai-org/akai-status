<?php

use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {
    return [
        'name' => 'TestEvent' . $faker->randomNumber(),
        'location' => 'L125BT',
        'startTime' => $faker->dateTimeThisYear(),
        'duration' => 120,
        'code' => $faker->word,
        'isPrivate' => false
    ];
});
