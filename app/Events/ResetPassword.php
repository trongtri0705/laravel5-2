<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ResetPassword extends Event
{
    use SerializesModels;

    public $email;

    /**
     * Create a new event instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
