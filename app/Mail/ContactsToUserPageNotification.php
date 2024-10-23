<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Log;

class ContactsToUserPageNotification extends Mailable
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
        $buildingMail = $this->subject('User Notification')
            ->with(['userNotification' => $this->userNotification]);

        $localeStr = App::getLocale();
        switch ($localeStr) {
            case 'de':
                $buildingMail = $buildingMail->markdown('email.contacts-pg.to-user-notification-de');
                break;

            case 'ru':
                $buildingMail = $buildingMail->markdown('email.contacts-pg.to-user-notification-ru');
                break;

            default:
                $buildingMail = $buildingMail->markdown('email.contacts-pg.to-user-notification-de');
                break;
        }

        return $buildingMail;
    }
}
