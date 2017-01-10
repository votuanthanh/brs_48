<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\AuthorRepositoryInterface;

class BookController extends BaseController
{
    protected $bookRepository;
    protected $categoryRepository;
    protected $authorRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        CategoryRepositoryInterface $categoryRepository,
        AuthorRepositoryInterface $authorRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['books'] = $this->bookRepository->getAllBookPaginate();

        return view('admin.book.index', $this->dataView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->dataView['optionAuthor'] = $this->authorRepository->optionAuthor();
        $this->dataView['optionCategory'] = $this->categoryRepository->optionCategory();

        return view('admin.book.create', $this->dataView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->bookRepository->create($request->all())) {
            flash(trans('common.noty.book.create.success'), 'success');

            return redirect()->action('Admin\BookController@index');
        }

        flash(trans('common.noty.book.create.success'), 'danger');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($id && $request->ajax()) {
            $this->dataView['book'] = $this->bookRepository->find($id);
            $this->dataView['optionAuthor'] = $this->authorRepository->optionAuthor();
            $this->dataView['optionCategory'] = $this->categoryRepository->optionCategory();

            return response()->json([
                'status' => true,
                'view' => view('include.modal.book.edit', $this->dataView)->render(),
                'star' => $this->dataView['book']->avg_rate,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => trans('common.noty.not_found_item', ['item' => 'Book']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->bookRepository->updateBook($request->all(), $id)) {
            flash(trans('common.noty.book.update.success'), 'success');

            return back();
        }

        flash(trans('common.noty.book.update.fail'), 'danger');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->bookRepository->delete($id)) {
            flash(trans('common.noty.book.delete.success'), 'success');

            return back();
        }

        flash(trans('common.noty.book.delete.fail'), 'danger');

        return back();
    }

    /**
     * Delete list books
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAnything(Request $request)
    {
        if ($request->has('idBooks') && $listId = $request->get('idBooks')) {
            if ($this->bookRepository->deleteAnything($listId)) {
                flash(trans('common.noty.book.delete.success'), 'success');

                return back();
            }
            flash(trans('common.noty.book.delete.fail'), 'danger');

            return back();
        }

        flash(trans('common.noty.book.delete.fail'), 'danger');

        return back();
    }
}
