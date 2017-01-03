<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    /**
     * Check email exist
     *
     * @param  string  $email
     *
     * @return boolean
     */
    public function isExistEmail($email)
    {
        if ($this->model->whereEmail($email)->first()) {
            return true;
        }
        return false;
    }
    /**
     * Register user
     *
     * @param  array $request
     *
     * @return mixed
     */
    public function create(array $request)
    {
        $fileName = isset($request['avatar'])
            ? uploadImage($request['avatar'], config('settings.user.avatar_path'))
            : config('settings.user.avatar_default');

        $user = [
            'name' => $request['name'],
            'email' => $request['email'],
            'avatar' => $fileName,
            'password' => $request['password'],
        ];

        $createUser = $this->model->create($user);

        if (!$createUser) {
            return false;
        }

        return $createUser;
    }
}
