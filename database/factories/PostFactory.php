<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'description' => $faker->paragraph(),
        'slug' => $faker->slug(4),
        'thumbnail' => 'post.png',
        'status' => rand(0, 1),
        'view_count' => rand(20, 200),
        'user_id' => 1
    ];
});
