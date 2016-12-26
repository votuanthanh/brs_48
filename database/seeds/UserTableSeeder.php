<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get all id of books
        $idBooks = Book::all()->pluck('id')->toArray();

        factory(User::class, 15)->create()
            ->each(function ($user) use ($idBooks) {
                $numberIdUsersRand = rand(0, count($idBooks));
                if ($numberIdUsersRand > 1) {
                    //add favorite books of user
                    $idsAttach = $this->getRandomValueArray($idBooks, $numberIdUsersRand);
                    $user->favoriteBooks()->attach($idsAttach);

                    if (rand(0, 4)) {
                        //Add read or reading book of user
                        $user->readingBooks()->attach($this->addPivotForReadingBooks($idsAttach));
                        //Add review books
                        $user->reviewBooks()->attach($this->addReviewBook($idsAttach));
                    }
                }
            });
        factory(User::class, 'role')->create(['email' => 'admin@gmail.com']);
    }

    /**
     * Get Random Value Of Array
     *
     * @param  array $arrayIndex
     *
     * @return array
     */
    public function getRandomValueArray($arrayIndex, $numberRandom)
    {
        foreach (array_rand($arrayIndex, $numberRandom) as $k) {
            $result[] = $arrayIndex[$k];
        }
        return $result;
    }

    /**
     * Add Pivot For Reading Books
     *
     * @param array
     * @return array
     */
    public function addPivotForReadingBooks($inputs)
    {
        foreach ($inputs as $key) {
            $result[$key] = [
                'is_completed' => rand(0, 1),
            ];
        }
        return $result;
    }
    /**
     * Add Review Book
     *
     * @param array $inputs
     * @return array
     */
    public function addReviewBook($inputs)
    {
        $faker = Faker\Factory::create();
        foreach ($inputs as $key) {
            $result[$key] = [
                'title' => $faker->sentence(rand(4, 8)),
                'content' => $faker->paragraph(3, true),
                'star' => rand(0, 5),
            ];
        }
        return $result;
    }
}
