<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class ContactsPageNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected array $userNotification = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $userNotification)
    {
        $this->userNotification = $userNotification;
        $this->onConnection('database')->onQueue('default');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('User Notification')
            ->markdown('email.contacts-pg.user-notification')
            ->with(['userNotification' => $this->userNotification]);
    }
}
