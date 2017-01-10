<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RequestBookRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\RequestBook;
use App\Mail\RequestBookToUser;
use Mail;

class RequestBookRepository extends BaseRepository implements RequestBookRepositoryInterface
{
    public function model()
    {
        return RequestBook::class;
    }

    /**
     * slip status is_accecpt request book
     *
     * @param int $id
     *
     * @return bool
     */
    public function setStatusAccepted($id)
    {
        if (!$id) {
            return false;
        }
        $requestBook = $this->model->find($id);

        if ($requestBook->isCheckAccepted()) {
            $option = config('settings.request_book.not_accept');
        } else {
            $option = config('settings.request_book.accepted');
            Mail::to($requestBook->user->email)->queue(new RequestBookToUser($id));
        }

        $requestBook->update(['is_accepted' => $option]);

        return $option;
    }

    /**
     * Delete list Request books
     *
     * @param  array $listId
     *
     * @return bool
     */
    public function deleteMany(array $listId)
    {
        if (!$listId) {
            return false;
        }

        return $this->model->whereIn('id', $listId)->delete();
    }

    public function deleteAcceptedBook()
    {
        return $this->model->accepted()->delete();
    }
}
