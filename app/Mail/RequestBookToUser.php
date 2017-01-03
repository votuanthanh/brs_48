<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\RequestBook;

class RequestBookToUser extends Mailable
{
    protected $idRequestBook;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->idRequestBook = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Send Mail accepted Book';

        return $this->view('include.email.request_book_to_user', ['requestBook' => RequestBook::find($this->idRequestBook)])
            ->subject($subject);
    }
}
