<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;

class HomeController extends BaseController
{
    protected $categoryRepository;
    protected $bookRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, BookRepositoryInterface $bookRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['booksEachCategory'] = $this->bookRepository->getBookEachCategory();
        $this->dataView['bookTopRated'] = $this->bookRepository->getTopRatedBook();
        $this->dataView['categories'] = $this->categoryRepository->all();

        return view('home', $this->dataView);
    }
}
