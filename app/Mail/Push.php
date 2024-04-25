<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Push extends Mailable
{
    use Queueable, SerializesModels;


    public $raw;
    public function __construct($raw)
    {
        $this->raw = $raw;
    }

    public function build()
    {
        return $this->view('newpassword');
    }
}
