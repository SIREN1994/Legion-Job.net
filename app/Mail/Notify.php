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
    public $job_title;
    public $job_company;
    public function __construct($user, $user_email, $job_title, $job_company)
    {
        $this->user = $user;
        $this->user_email = $user_email;
        $this->job_title = $job_title;
        $this->job_company = $job_company;
    }

    public function build()
    {
        return $this->view('mailer');
    }
}
