<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $email;
    public $subject;


    public function __construct($email,$otp,$subject)
    {
        $this->otp = $otp;
        $this->email = $email;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->view('otp');
    }
}