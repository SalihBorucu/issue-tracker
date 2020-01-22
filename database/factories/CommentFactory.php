<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "task_id" => rand(1, 45),
        'user_id' => rand(1, 10),
        'message' => $faker->sentence(rand(5, 20)),

    ];
});
