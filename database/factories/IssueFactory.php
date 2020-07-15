<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Issue;
use Faker\Generator as Faker;

$factory->define(Issue::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(),
        "status" => $faker->randomDigit(0, 1),
        "description" => $faker->paragraph(),
        "pdf" => 'bindu.pdf',
        "thumbnail" => $faker->imageUrl(),
        "slug" => $faker->slug(),
        "download_count" => mt_rand(10, 100),
        "reader_count" => mt_rand(30, 400),
        "user_id" => 1
    ];
});
