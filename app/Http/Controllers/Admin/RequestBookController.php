<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\RequestBookRepositoryInterface;
use App\Models\RequestBook;

class RequestBookController extends BaseController
{
    protected $bookRepository;

    public function __construct(RequestBookRepositoryInterface $requestBookRepository)
    {
        $this->requestBookRepository = $requestBookRepository;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['requestBooks'] = $this->requestBookRepository->paginate();

        return view('admin.book.request_book', $this->dataView);
    }

    /**
     * Ajax status is_accecpt that Request Book is
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return json
     */
    public function ajaxAccepted(Request $request)
    {
        $idRequestBook = $request->get('id');
        $handleAccepte = $this->requestBookRepository->setStatusAccepted($idRequestBook);

        if ($idRequestBook) {
            return response()->json([
                'status' => config('settings.status.success'),
                'option' => $handleAccepte,
            ]);
        }

        return response()->json([
            'status' => config('settings.status.fail'),
            'message' => trans('common.noty.not_found_item'),
        ]);
    }

     /**
     * Delete list request books
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if ($request->has('requestBook') && $listId = $request->get('requestBook')) {
            if ($this->requestBookRepository->deleteMany($listId)) {
                flash(trans('common.noty.book.request.delete.success'), 'success');

                return back();
            }
            flash(trans('common.noty.book.request.delete.fail'), 'danger');

            return back();
        }

        flash(trans('common.noty.book.request.delete.fail'), 'danger');

        return back();
    }
}
