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

use App\Models\User;
use App\Models\Review;
use App\Models\Comment;

$factory->define(Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->paragraph(rand(1, 3), true),
        'user_id' => function () {
            $idsUser = User::all()->pluck('id')->toArray();
            return $idsUser[array_rand($idsUser)];
        },
        'review_id' => function () {
            $idCategories = Review::all()->pluck('id')->toArray();
            return $idCategories[array_rand($idCategories)];
        },
    ];
});
