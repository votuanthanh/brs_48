<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class SearchController extends BaseController
{
    protected $userRepository;
    protected $bookRepository;
    protected $categoryRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        BookRepositoryInterface $bookRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Suggestion book or user
     *
     * @param  Illuminate\Http\Request;
     * @return json
     */
    public function find(Request $request)
    {
        //get search query
        $itemNeeds = $request->get('q');

        // Search Book
        if ($request->get('type') == 'book') {
            if ($res = $this->bookRepository->searchBook($itemNeeds)) {
                return response()->json($res);
            }

            return response()->json([
                'status' => false,
                'message' => trans('form.noty.book_not_found'),
            ]);
        }

        //Search User
        if ($res = $this->userRepository->searchUser($itemNeeds)) {
            return response()->json($res);
        }

        return response()->json([
            'status' => false,
            'message' => trans('form.noty.user_not_found'),
        ]);
    }

    /**
     * Search Book
     *
     * @param  Illuminate\Http\Request;
     *
     * @return response
     */
    public function handleSearch(Request $request)
    {
        $this->dataView['categories'] = $this->categoryRepository->all();

        $querySearch = $request->get('q');

        //Search book from category
        if ($request->has('category')) {
            if ($category = $this->categoryRepository->where('name', $request->get('category'))->first()) {
                $this->dataView['books'] = $category->books()->paginate(config('settings.pagination.limit'));

                return view('web.search.index', $this->dataView);
            }
        }

        //Search full text Books
        if ($request->has('q') || isset($querySearch)) {
            $this->dataView['books'] = $this->bookRepository->search($querySearch)
                ->paginate(config('settings.pagination.limit'));

            return view('web.search.index', $this->dataView);
        }

        flash(trans('common.noty.book.search.fail'), 'danger');

        return back();
    }
}
