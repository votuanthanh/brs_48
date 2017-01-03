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
                flashMessage(
                    trans('common.text.book'),
                    trans('common.text.deleted'),
                    trans('common.text.success')
                );
                return back();
            }
        }

        flashMessage(
            trans('common.text.book'),
            trans('common.text.deleted'),
            trans('common.text.fail'),
            'danger'
        );
        return back();
    }
}
