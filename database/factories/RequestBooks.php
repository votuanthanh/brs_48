<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use App\Models\RequestBook;
use App\Models\User;

$factory->define(RequestBook::class, function (Faker\Generator $faker) {
    return [
        'book_name' => str_replace('.', '', $faker->sentence(rand(4, 8))),
        'description' => $faker->paragraph(3, true),
        'is_accepted' => rand(0, 1),
        'requested_book_id' => null,
        'user_id' => function () {
            $idUsers = User::all()->pluck('id')->toArray();
            return $idUsers[array_rand($idUsers)];
        },
    ];
});
