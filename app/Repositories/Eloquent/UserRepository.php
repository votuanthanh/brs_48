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
            ? $this->uploadAvatar()
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

    /**
     * Upload Avatar
     *
     * @param  string $oldImage
     *
     * @return mixed
     */
    public function uploadAvatar($oldImage = null)
    {
        $fileAvatar = Input::file('avatar');
        $destinationPath = config('settings.user.avatar_path');

        //set unique name avatar
        $fileName = uniqid(time()) . '.' . $fileAvatar->getClientOriginalExtension();

        //move directory folder image
        Input::file('avatar')->move($destinationPath, $fileName);
        $imageOldDestinationPath = $destinationPath.$oldImage;

        //delete old image for update avatar
        if (!empty($oldImage) && file_exists($imageOldDestinationPath)) {
            File::delete($imageOldDestinationPath);
        }

        return $fileName;
    }
}
