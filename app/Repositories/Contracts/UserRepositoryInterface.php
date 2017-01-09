<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function isExistEmail($email);

    public function searchUser($item);

    public function handleRelationUser($idUser);

    public function createRequestBook($inputs);

    public function cancelRequestBook($inputs);

    public function deleteAnything($users);
}
