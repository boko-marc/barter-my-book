<?php

namespace Core\Users\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $year, $code, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $code)
    {
        $this->year = date("Y");
        $this->code = $code;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('APP_FROM_MAIL'), env('APP_NAME'))
            ->subject("Activation de compte")
            ->view('emails.users.account_activation');
    }
}
