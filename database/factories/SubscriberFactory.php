<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        "name"=>$faker->name,
        "mobile"=>$faker->phoneNumber,
        "email"=>$faker->email,
        "address"=>$faker->address,
        // "status"=>$faker->rand(0,1),
        // "user_id"
    ];
});
