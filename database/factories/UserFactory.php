<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'donor_id' => $faker->unique()->userName,
        'donor_access' => [
            'id' => $faker->randomNumber(),
            'token' => Str::random(10)
        ],
        'donor_info' => [
            'id' => $faker->randomNumber(),
            'domain' => $faker->domainName
        ],

        'sp_refresh_token' => Str::random(783),
        'sp_user_info' => [
            'id' => $faker->randomNumber(),
            'lang' => $faker->locale,
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber
        ],
        'status' => 1,
    ];
});
