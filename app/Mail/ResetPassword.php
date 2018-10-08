<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable implements ShouldQueue {

    use Queueable,
        SerializesModels;

    protected $user;
    protected $author;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $author) {
        $this->user = $user;
        $this->author = $author;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('email.reset_password')->subject("[Blog TrungLT] Khôi phục mật khẩu")
                ->with( [ 'user' => $this->user, 'author' => $this->author ] );
    }

}
