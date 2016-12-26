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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => 0,
        'avatar' => 'http://gravatar.com/avatar/' . md5(strtolower(trim($faker->email))) . '?s=200&d=wavatar',
        'password' => $password ?: $password = bcrypt('123123'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\Models\User::class, 'role', function ($faker) use ($factory) {
    $post = $factory->raw('App\Models\User');

    return array_merge($post, ['role' => 1]);
});
