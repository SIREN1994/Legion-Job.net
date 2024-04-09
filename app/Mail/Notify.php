<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $user_email;
    public function __construct($user, $user_email)
    {
        $this->user = $user;
        $this->user_email = $user_email;
    }

    public function build()
    {
        return $this->view('mailer');
    }
}
