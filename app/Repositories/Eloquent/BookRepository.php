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
        if (!$ids) {
            return false;
        }

        $this->model->whereIn('id', $ids)->get()->each(function ($book) {
            $book->delete();
        });

        return true;
    }

    /**
     * Search Book
     *
     * @param  string $item
     *
     * @return mixed
     */
    public function searchBook($item)
    {
        $books =  $this->model->search($item)->get();

        if ($books->count()) {
            foreach ($books as $book) {
                $response[] =[
                    'status' => true,
                    'suggest' => $book->title,
                    'view' => view('web.search.book', compact('book'))->render(),
                ];
            }
            return $response;
        }

        return false;
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlug($slug);
    }

    /**
     * Check read or reading book of user current
     *
     * @param Illuminate\Database\Eloquent\Collection $book
     * @param int $idUser
     *
     * @return mixed
     */
    private function readOrReadingOfUser($book, $idUser = null)
    {
        if (auth()->check()
            && $user = $book->readingUsers
                ->where('id', isset($idUser) ? $idUser : auth()->user()->id)
                ->first()
        ) {
            return $user->pivot->is_completed;
        }

        return null;
    }

    /**
     * Compute Percent For Book
     *
     * @param Illuminate\Database\Eloquent\Collection $book
     *
     * @return mixed
     */
    private function percentEachReviewBook($book)
    {
        $reviews = $book->reviews()->select('star', \DB::raw('count(star) as count'))
            ->groupBy('star')
            ->get();

        $totalStar = array_sum($reviews->pluck('count')->toArray());
        $fiveStar = collect([1, 2, 3, 4, 5]);
        $listStar = $reviews->pluck('star');
        //dd($listStar);
        //diff star
        $notExistStar = $fiveStar->diff($listStar);

        //set earch star if user not review
        if ($notExistStar->count()) {
            foreach ($notExistStar as $value) {
                $data[$value] = [
                    'countRewiewer' => 0,
                    'percentStar' => 0,
                ];
            }
        }

        foreach ($reviews as $review) {
            $data[$review->star] = [
                'countRewiewer' => $review->count,
                'percentStar' => round(($review->count / $totalStar) * 100),
            ];
        }

        if (!$data) {
            return null;
        }

        return $data;
    }

    /**
     * Compute Rating Avg
     *
     * @param  array $data
     *
     * @return float
     */
    private function avgRate($data)
    {
        if (!$data) {
            return 0;
        }
        //compute avg star
        $sum = $totalStar = 0;
        foreach ($data as $star => $value) {
            $sum += $star * $value['countRewiewer'];
            $totalStar += $value['countRewiewer'];
        }

        return round($sum / $totalStar, 1);
    }

    public function test()
    {
        $books = $this->model->all();
        foreach ($books as $book) {
            $data = $this->percentEachReviewBook($book);
            $avgRate = $this->avgRate($data);
            $book->update(['avg_rate' => $avgRate]);
        }
    }

    /**
     * Set data for view
     * @param  string $slug
     * @return array
     */
    public function dataForView($slug)
    {
        // search book where slug field
        $book = $this->findBySlug($slug)
            ->load(
                'reviews.comments.user',
                'reviews.likes',
                'reviews.user'
            );

        //show percent review
        $data['counter'] = $this->percentEachReviewBook($book);
        krsort($data['counter']);

        //update avg rate current for book
        $book->update(['avg_rate' => $this->avgRate($data['counter'])]);

        // data book
        $data['item'] = [
            'book' => $book,
            'statusBook' => $this->readOrReadingOfUser($book),
        ];

        //dd($data);
        return $data;
    }

    /**
     * [Ajax] get status updated
     * @param  int $id
     * @return bool
     */
    public function statusFavoriteBook($id)
    {
        $book = $this->model->find($id);

        $idRelatedUser = $book->getUserFavoriteIds();
        $idUserCurrent = $this->getCurrentUser()->id;

        if ($idRelatedUser->contains($idUserCurrent)) {
            $book->favoriteUsers()->detach($idUserCurrent);
            return false;
        }

        $book->favoriteUsers()->attach($idUserCurrent);
        return true;
    }

    /**
     * Set Read Or Reading Book
     *
     * @param int $id
     * @param bool $status
     * @return boolean
     */
    public function setReadOrReadingBook($id, $status)
    {
        $book = $this->model->find($id);

        return $this->updateStatusBook($this->readOrReadingOfUser($book), $status, $book);
    }

    /**
     * Update Status Book
     *
     * @param  mixed $statusCurrentBook
     * @param  bool $status
     * @param  Collection $book
     * @return bool
     */
    private function updateStatusBook($statusCurrentBook, $status, $book)
    {
        $idUserCurrent = $this->getCurrentUser()->id;

        if (isset($statusCurrentBook)) {
            //When is_complete current book different status request user to update status book
            if ($statusCurrentBook != $status) {
                $book->readingUsers()->syncWithoutDetaching([$idUserCurrent => ['is_completed' => $status]]);

                return true;
            }
            $book->readingUsers()->detach($idUserCurrent);

            return false;
        }

        $book->readingUsers()->attach([$idUserCurrent => ['is_completed' => $status]]);

        return true;
    }
}
