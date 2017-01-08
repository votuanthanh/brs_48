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

    public function likeReivew($id)
    {
        if ($this->reviewRepository->createLike($id)) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

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
