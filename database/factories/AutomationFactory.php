<?php

use App\Models\Automation;
use Faker\Generator as Faker;

$factory->define(Automation::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'webhook_id' => 1,
        'workflow' => rand(0, 1),
        'meta' => ['book_id' => $faker->randomNumber(), 'post_url' => $faker->url],
        'mapping' => [$faker->randomLetter => $faker->randomLetter],
        'source' => 'order.create',
        'status' => rand(0, 1),
        'name' => 'My_first_automation ' . $faker->randomNumber(),
    ];
});
