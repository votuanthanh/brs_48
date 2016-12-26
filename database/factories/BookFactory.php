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
use App\Models\Category;
use App\Models\Author;

$factory->define(App\Models\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => str_replace('.', '', $faker->sentence(rand(4, 8))),
        'description' => $faker->paragraph(3, true),
        'publish_date' => $faker->dateTimeBetween('-10 years', 'now'),
        'image' => config('settings.book.image_deault'),
        'number_of_pages' => rand(100, 300),
        'avg_rate' => round(rand(10, 50) / 10, 2),
        'category_id' => function () {
            $idCategories = Category::all()->pluck('id')->toArray();
            return $idCategories[array_rand($idCategories)];
        },
        'author_id' => function () {
            $idAuthors = Author::all()->pluck('id')->toArray();
            return $idAuthors[array_rand($idAuthors)];
        },
    ];
});
