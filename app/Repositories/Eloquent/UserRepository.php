<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Auth;

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

    /**
     * Update Profile's User
     *
     * @param  array   $data
     * @param  int  $id
     * @param  boolean $withSoftDeletes
     * @return bool
     */
    public function update(array $data, $id, $withSoftDeletes = false)
    {
        $currentUser = $this->getCurrentUser();

        if (!$data['password']) {
            unset($data['password']);
        }

        $oldImage = $currentUser->avatar;
        $data['avatar'] = isset($data['avatar'])
            ? uploadImage($data['avatar'], config('settings.user.avatar_path'), $oldImage)
            : $oldImage;

        return $this->model->find($id)->update($data);
    }

    /**
     * Search User
     *
     * @param  string $item
     *
     * @return mixed
     */
    public function searchUser($item)
    {
        $users =  $this->model->search($item)
            ->with('following', 'followers')
            ->get();
        if ($users->count()) {
            foreach ($users as $user) {
                $response[] =[
                    'status' => true,
                    'suggest' => $user->name,
                    'view' => view('web.search.user', compact('user'))->render(),
                ];
            }
            return $response;
        }

        return false;
    }

    /**
     * Set Relationship User
     *
     * @param  int $idUser
     * @return bool
     */
    public function handleRelationUser($idUser)
    {
        if (!$idUser) {
            return false;
        }

        $user = $this->model->find($idUser);
        $userCurrent = $this->getCurrentUser();

        if ($userCurrent->following->contains('id', $idUser)) {
            $userCurrent->following()->detach($idUser);

            return false;
        }

        $userCurrent->following()->attach($idUser);

        return true;
    }

    /**
     * Creat new a request book from user
     *
     * @param  array $inputs
     * @return Collection
     */
    public function createRequestBook($inputs)
    {
        $idUser = $inputs['user_id'];
        $data = [
            'book_name' => $inputs['book_name'],
            'description' => $inputs['description'],
            'is_accepted' => false,
        ];

        return $this->model->find($inputs['user_id'])
            ->requestBooks()
            ->create($data);
    }

    /**
     * Delete Request Book
     *
     * @param  array $inputs
     * @return bool
     */
    public function cancelRequestBook($inputs)
    {
        $idUser = $inputs['idUser'];

        $idBookRequest = $inputs['idRequest'];

        return $this->model->find($idUser)
            ->requestBooks()
            ->where('user_id', $idUser)
            ->where('id', $idBookRequest)
            ->delete();
    }

    public function deleteAnything($users)
    {
        $admin = $this->model->where('role', config('settings.user.role.admin'))
            ->first();
        $listUser = $users['users'];

        if (in_array($admin->id, $users['users'])) {
            return false;
        }

        $this->model->whereIn('id', $listUser)->get()->each(function ($user) {
            $user->delete();
        });

        return true;
    }
}
