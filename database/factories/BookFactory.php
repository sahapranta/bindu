<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->name('men'),
        'slug' => $faker->slug(5),
        'description' => $faker->text(),
        'price' => rand(50, 250),
        'pdf' => 'book.pdf',
        'thumbnail' => 'book.png',
        'status' => rand(0, 1),
        'download_count' => rand(40, 299),
        'view_count' => rand(100, 200),
        'user_id' => 1
    ];
});
