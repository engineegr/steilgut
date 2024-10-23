<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactsPageNotification;
// use App\Mail\ContactsToUserPageNotification;
// use App\Models\UserNotification;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Config;

class ContactsNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $arrayNotificationObj = $request->input('notification');
        $localeStr = App::getLocale();

        // Mail::to([env('MAIL_USERNAME')])->locale($localeStr)->queue(new ContactsPageNotification($arrayNotificationObj));
        // Mail::to([$arrayNotificationObj['email']])->locale($localeStr)->queue(new ContactsToUserPageNotification($arrayNotificationObj));
        /*
         * Precaution: if we use <php artisan config:cache> we don't have any access to env('key') from the code, we must use Config Facade
         */
        $mailTo = Config::get('mail.from.address');
        /* No need extra setup for the task queue */
        Mail::to($mailTo)->locale($localeStr)->send(new ContactsPageNotification($arrayNotificationObj));
        // Mail::to([$arrayNotificationObj['email']])->locale($localeStr)->send(new ContactsToUserPageNotification($arrayNotificationObj));
    }
}
