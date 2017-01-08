<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function model()
    {
        return Category::class;
    }

    /**
     * Get Option Category for books.
     *
     * @return array
     */
    public function optionCategory()
    {
        return $this->model->all()
            ->pluck('name', 'id')
            ->toArray();
    }
}
