<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\Book;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function model()
    {
        return Book::class;
    }

    /**
     * Eager Loading for Books
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllBookWith()
    {
        $eagerLoading = $this->model
            ->with('author')
            ->with('category')
            ->with('readingUsers')
            ->with('favoriteUsers');

        return $eagerLoading;
    }

    public function getBookEachCategory()
    {
        $allbook = $this->getAllBookWith()->get()->sortBy('category_id');

        foreach ($allbook as $book) {
            $idCategory = $book->category_id;
            if (!isset($data[$idCategory])) {
                $data[$idCategory] = [];
                $data[$idCategory]['name_category'] = $book->category->name;

                //rest Limit books with category
                $limit = 0;
            }
            // Get book with config
            if ($limit < config('settings.book.limit')) {
                //setdefault status book for guest
                $statusReadBook = $statusFavoriteBook = null;

                // Check auth
                if (auth()->check()) {
                    if ($userRead = $book->readingUsers->where('id', $this->getCurrentUser()->id)->first()) {
                        //add status book : reading(0) or read (1)
                        $statusReadBook = $userRead->pivot->is_completed;
                    }
                    if ($book->favoriteUsers->where('id', $this->getCurrentUser()->id)->first()) {
                        //add favorite book of user
                        $statusFavoriteBook = true;
                    }
                }

                $data[$idCategory]['datas'][] = [
                    'is_read' => isset($statusReadBook) ? $statusReadBook : null,
                    'is_favorite' => isset($statusFavoriteBook) ? $statusFavoriteBook : null,
                    'book' => $book,
                ];
                $limit++;
            }
        }

        return $data;
    }

    /**
     * Get Top Rated Book with guest or user
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getTopRatedBook()
    {
        return $this->getAllBookWith()
            ->latest('avg_rate')
            ->take(config('settings.book.limit'))
            ->get();
    }
}
