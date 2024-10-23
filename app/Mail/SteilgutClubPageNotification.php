<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SteilgutClubPageNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $customerNotification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $customerNotificationData)
    {
        $this->customerNotification = $customerNotificationData;
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
            ->markdown('email.steilgutClub-pg.user-notification')
            ->with([
                'customer' => $this->customerNotification,
            ]);
    }
}
