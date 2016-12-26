<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthorTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(BookTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RequestBookSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(LikeTableSeeder::class);
    }
}
