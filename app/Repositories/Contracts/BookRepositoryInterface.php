<?php

namespace App\Repositories\Contracts;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function getTopRatedBook();

    public function getBookEachCategory();

    public function updateBook(array $request, $id);

    public function deleteAnything(array $ids);
}
