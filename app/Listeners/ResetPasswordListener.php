<?php

namespace App\Listeners;

use App\Events\ResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;

class ResetPasswordListener
{
    use ResetsPasswords;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ResetPassword $event
     */
    public function handle(ResetPassword $event)
    {
        try {
            return Password::sendResetLink($event->email, function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
        } catch (\Exception $e) {
            return false;
        }
    }
}
