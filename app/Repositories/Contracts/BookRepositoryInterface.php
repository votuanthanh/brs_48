<?php

namespace App\Repositories\Contracts;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function getTopRatedBook();

    public function getBookEachCategory();

    public function updateBook(array $request, $id);

    public function deleteAnything(array $ids);

    public function searchBook($item);

    public function findBySlug($slug);

    public function dataForView($slug);

    public function statusFavoriteBook($id);

    public function setReadOrReadingBook($id, $status);
}
