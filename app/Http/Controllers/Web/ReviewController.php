<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewController extends BaseController
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Store Review
     *
     * @param  Illuminate\Http\Request $request
     * @return response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'content', 'star', 'book_id']);

        if ($this->reviewRepository->create($data)) {
            flash(trans('common.noty.review.success'), 'success');
            return back();
        }

        flash(trans('common.noty.review.fail'), 'danger');

        return back();
    }

    /**
     * Like Review Book
     *
     * @param  int $id
     * @return resonese
     */
    public function likeReivew($id)
    {
        $status = false;
        if ($this->reviewRepository->createLike($id)) {
            $status = true;
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Ajax Handle Comment
     *
     * @param  Illuminate\Http\Request $request
     * @return json
     */
    public function handleComment(Request $request)
    {
        if ($comment = $this->reviewRepository->createComment($request)) {
            return response()->json([
                'status' => true,
                'view' => view('include.comment', compact('comment'))->render(),
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
