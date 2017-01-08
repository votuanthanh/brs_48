<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\Review;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model()
    {
        return Review::class;
    }

    public function createLike($idReview)
    {
        if ($this->model->find($idReview)->likes()->create(['user_id' => auth()->user()->id])) {
            return true;
        }

        return false;
    }

    /**
     * Create Comment For Review
     * @param  array $input
     * @return bool
     */
    public function createComment($input)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'content' => $input['content'],
        ];

        return $this->model->find($input['review_id'])->comments()->create($data);
    }
}
