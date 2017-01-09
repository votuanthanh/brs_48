<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\UpdateUserRequest;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dataView['users'] = $this->userRepository->paginate();

        return view('admin.user.index', $this->dataView);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->dataView['user'] = $this->userRepository->find($id);

        return view('admin.user.edit', $this->dataView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $inputs = $request->only(['name', 'email', 'password', 'avatar']);

        if ($this->userRepository->update($inputs, $id)) {
            flash(trans('common.noty.user.update_profile.success'), 'success');

            return back();
        }

        flash(trans('common.noty.user.update_profile.fail'), 'danger');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request)
    {
        $listUser = $request->only(['users']);

        if ($this->userRepository->deleteAnything($listUser)) {
            flash(trans('common.noty.user.delete.success'), 'success');

            return back();
        }

        flash(trans('common.noty.user.delete.fail'), 'danger');

        return back();
    }
}
