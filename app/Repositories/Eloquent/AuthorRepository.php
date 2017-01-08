<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\Author;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function model()
    {
        return Author::class;
    }

    /**
     * Get Option Author for books.
     *
     * @return array
     */
    public function optionAuthor()
    {
        return $this->model->all()
            ->pluck('name', 'id')
            ->toArray();
    }
}
