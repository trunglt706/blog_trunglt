<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActiveUser extends Mailable implements ShouldQueue {

    use Queueable,
        SerializesModels;

    protected $name;
    protected $active_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $active_code) {
        $this->name = $name;
        $this->active_code = $active_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('emails.active')->subject('Blog Trung - Kích hoạt tài khoản')->with(['name' => $this->name, 'active_code' => $this->active_code]);
    }

}
