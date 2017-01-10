<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show view all profile's user
     *
     * @param  int $id
     * @param  string $tabCurrent
     * @return response
     */
    public function show($id, $tabCurrent = null)
    {
        if (!isset($tabCurrent)) {
            $tabCurrent = config('settings.tab.favorite_book');
        }

        $user = $this->userRepository->find($id);
        $this->dataView['user'] = $user;
        $this->dataView['tabCurrent'] = $tabCurrent;

        switch ($tabCurrent) {
            case config('settings.tab.favorite_book'):
                $this->dataView['favoriteBooks'] = $user->favoriteBooks()
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            case config('settings.tab.review_book'):
                $this->dataView['reviewBooks'] = $user->reviewBooks()
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            case config('settings.tab.reading_book'):
                $this->dataView['readingBooks'] = $user->readingBooks()
                    ->wherePivot('is_completed', false)
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            case config('settings.tab.read_book'):
                $this->dataView['readBooks'] = $user->readingBooks()
                    ->wherePivot('is_completed', true)
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            case config('settings.tab.following_users'):
                $this->dataView['following'] = $user->following()
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            case config('settings.tab.followers'):
                $this->dataView['followers'] = $user->followers()
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            case config('settings.tab.request_book'):
                $this->dataView['requestBooks'] = $user->requestBooks()
                    ->latest()
                    ->paginate(config('settings.pagination.limit'));
                break;

            default:
                # code...
                break;
        }

        return view('web.user.index', $this->dataView);
    }

    /**
     * Do Ajax Following Or Follower
     *
     * @param  Illuminate\Http\Request $request
     * @return json
     */
    public function ajaxRelationship(Request $request)
    {
        $idUser = $request->get('id');

        $status = $this->userRepository->handleRelationUser($idUser);

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Handle Request Book To Admin
     *
     * @param  Illuminate\Http\Request $request
     * @return response
     */
    public function storeRequestBook(Request $request)
    {
        if ($this->userRepository->createRequestBook($request->all())) {
            flash(trans('common.noty.request_book.success'), 'success');

            return back();
        }

        flash(trans('common.noty.request_book.fail'), 'danger');

        return back();
    }

    /**
     * Handle Ajax Cancel Request Book
     *
     * @param  Request $request
     * @return json
     */
    public function ajaxCancelRequestBook(Request $request)
    {
        $status = $this->userRepository->cancelRequestBook($request->all());

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Update Profile's User
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $inputs = $request->only(['name', 'email', 'password', 'avatar']);

        if ($this->userRepository->update($inputs, $id)) {
            flash(trans('common.noty.user.update_profile.success'), 'success');
            return back();
        }

        flash(trans('common.noty.user.update_profile.fail'), 'danger');

        return back();
    }
}
