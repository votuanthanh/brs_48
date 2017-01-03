<?php

namespace App\Repositories\Contracts;

interface RequestBookRepositoryInterface extends RepositoryInterface
{
    public function setStatusAccepted($id);

    public function deleteMany(array $listId);
}
