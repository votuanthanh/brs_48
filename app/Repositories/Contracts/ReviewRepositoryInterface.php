<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function createLike($idReview);

    public function createComment($input);
}
