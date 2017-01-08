<?php

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Author::class, 20)->create();
    }
}
