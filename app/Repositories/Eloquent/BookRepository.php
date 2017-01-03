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
    private function getAllBookWith()
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

    public function getAllBookPaginate()
    {
        return $this->model->with('author')->paginate(10);
    }

    /**
     * Data Request for store or update
     *
     * @param  array $request
     * @param  int $id
     *
     * @return array
     */
    private function dataRequest(array $request, $id = null)
    {
        //flag default no update image form book
        $haveUpdate = false;
        if (isset($id) && $book = $this->model->find($id)) {
            //have update image
            $haveUpdate = true;
        }

        $fileName = isset($request['image'])
            ? uploadImage($request['image'], config('settings.book.image_path'), $haveUpdate ? $book->image : null)
            : ($haveUpdate ? $book->image : config('settings.book.image_deault'));

        $book = [
            'title' => $request['title'],
            'author_id' => $request['author'],
            'category_id' => $request['category'],
            'description' => $request['description'],
            'publish_date' => $request['publish_date'],
            'avg_rate' => $request['score'],
            'number_of_pages' => $request['pages'],
            'image' => $fileName,
        ];

        return $book;
    }

    /**
     * Register book
     *
     * @param  array $request
     *
     * @return mixed
     */
    public function create(array $request)
    {
        if (!$this->model->create($this->dataRequest($request))) {
            return false;
        }

        return true;
    }

    /**
     * Update a book
     *
     * @param  array $request
     * @param  int $id
     *
     * @return bool
     */
    public function updateBook(array $request, $id)
    {
        if ($this->model->find($id)->update($this->dataRequest($request, $id))) {
            return true;
        }

        return false;
    }

    /**
     * Delete list books
     *
     * @param  array $ids
     *
     * @return bool
     */
    public function deleteAnything(array $ids)
    {
        if ($this->model->whereIn('id', $ids)->delete()) {
            return true;
        }

        return false;
    }
}
