<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewletter extends Mailable implements ShouldQueue {

    use Queueable,
        SerializesModels;

    protected $tieude;
    protected $noidung;
    protected $urltrack;
    protected $newletter_id;
    protected $user_id;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tieude, $noidung, $urltrack, $newletter_id, $user_id, $email) {
        $this->tieude = $tieude;
        $this->noidung = $noidung;
        $this->urltrack = $urltrack;
        $this->newletter_id = $newletter_id;
        $this->user_id = $user_id;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('email.feedback')->subject($this->tieude)
                ->with(
                        [
                            'noidung' => $this->noidung, 
                            'urltrack' => $this->urltrack,
                            'newletter_id' => $this->newletter_id, 
                            'user_id' => $this->user_id,
                            'email' => $this->email
                        ]
                        );
    }

}
