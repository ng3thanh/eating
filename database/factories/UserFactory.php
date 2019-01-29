<?php

use Faker\Generator as Faker;
use App\Models\Users;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Users::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'birthday' => $faker->date,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'credit_card_type' => $faker->creditCardType,
        'credit_card_number' => $faker->creditCardNumber,
        'credit_card_expiration_date' => $faker->creditCardExpirationDate,
        'credit_card_details' => $faker->realText,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
