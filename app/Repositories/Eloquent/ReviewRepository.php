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

    /**
     * Create Like For View
     *
     * @param  int $idReview
     * @return bool
     */
    public function createLike($idReview)
    {
        if (auth()->check() && $this->model->find($idReview)->likes()->create(['user_id' => auth()->id])) {
            return true;
        }

        return false;
    }

    /**
     * Create Comment For Review
     *
     * @param  array $input
     * @return bool
     */
    public function createComment($input)
    {
        if (!auth()->check()) {
            return false;
        }

        $data = [
            'user_id' => auth()->id,
            'content' => $input['content'],
        ];

        return $this->model->find($input['review_id'])->comments()->create($data);
    }
}
