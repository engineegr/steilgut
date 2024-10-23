<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DegustationPageNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $degustationNotification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $degustationNotificationData)
    {
        $this->degustationNotification = $degustationNotificationData;
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
            ->markdown('email.degustation-pg.from-user-notification')
            ->with([
                'degustation' => $this->degustationNotification,
            ]);
    }
}
