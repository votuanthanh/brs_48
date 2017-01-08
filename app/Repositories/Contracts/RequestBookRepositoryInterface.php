<?php

namespace App\Repositories\Contracts;

interface RequestBookRepositoryInterface extends RepositoryInterface
{
    public function setStatusAccecpted($id);

    public function deleteMany(array $listId);
}
