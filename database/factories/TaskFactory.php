<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4, true),
        'description' => $faker->sentence(rand(5, 100)),
        'is_completed' => rand(0, 1),
        'due_date' => now(),
        'user_id' => rand(1, 9),
        "board_id" => rand(1, 3),
    ];
});
