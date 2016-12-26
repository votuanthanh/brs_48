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
use App\Models\Like;
use App\Models\User;
use App\Models\Review;
use App\Models\Comment;

$factory->define(Like::class, function (Faker\Generator $faker) {
    $idRandom = rand(0, 1);
    $idUsers = User::all()->pluck('id')->toArray();
    $idReviews = Review::all()->pluck('id')->toArray();
    $idComments = Comment::all()->pluck('id')->toArray();

    return [
        'target_type' => $idRandom ? Review::class : Comment::class,
        'target_id' => $idRandom ? $idReviews[array_rand($idReviews)] : $idComments[array_rand($idComments)],
        'user_id' => $idUsers[array_rand($idUsers)],
    ];
});
