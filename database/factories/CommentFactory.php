<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "task_id" => rand(20, 22),
        'user_id' => rand(1, 21),
        'message' => $faker->sentence(rand(5, 20)),

    ];
});
