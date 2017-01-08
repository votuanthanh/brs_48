<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Models\Book;
use App\Models\Review;

class BookController extends BaseController
{
    protected $bookrepository;

    /**
     * Construct
     *
     * @param BookRepositoryInterface $bookrepository
     */
    public function __construct(BookRepositoryInterface $bookrepository)
    {
        $this->bookrepository = $bookrepository;
    }
    public function index($slug)
    {
        $this->dataView['data'] = $this->bookrepository->dataForView($slug);
        return view('web.book.index', $this->dataView);
    }

    /**
     * Do Ajax Favorite Book
     *
     * @param  Illuminate\Http\Request $request
     * @return response
     */
    public function ajaxFavoriteBook(Request $request)
    {
        $status = $this->bookrepository->statusFavoriteBook($request->get('id'));

        return response()->json(['status' => $status]);
    }

    /**
     * Do Ajax Status Book
     *
     * @param  Illuminate\Http\Request $request
     * @return json
     */
    public function ajaxStatusBook(Request $request)
    {
        $idBook = $request->get('id');

        $statusRequest = $request->get('status');

        $status = $this->bookrepository->setReadOrReadingBook($idBook, $statusRequest);

        return response()->json(['status' => $status]);
    }
}
