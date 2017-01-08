<?php

use Illuminate\Database\Seeder;
use App\Models\RequestBook;

class RequestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(RequestBook::class, 100)->create();
    }
}
