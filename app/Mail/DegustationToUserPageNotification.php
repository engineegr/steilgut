<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class DegustationToUserPageNotification extends Mailable
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
        $buildingMail = $this->subject('User Notification')->with([
            'degustation' => $this->degustationNotification,
        ]);

        $localeStr = App::getLocale();
        switch ($localeStr) {
            case 'de':
                $buildingMail = $buildingMail->markdown('email.degustation-pg.to-user-notification-de');
                break;

            case 'ru':
                $buildingMail = $buildingMail->markdown('email.degustation-pg.to-user-notification-ru');
                break;

            default:
                $buildingMail = $buildingMail->markdown('email.degustation-pg.to-user-notification-de');
                break;
        }

        return $buildingMail;
    }
}
