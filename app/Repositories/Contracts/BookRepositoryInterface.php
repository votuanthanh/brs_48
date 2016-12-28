<?php

namespace App\Repositories\Contracts;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function getTopRatedBook();

    public function getBookEachCategory();
}
