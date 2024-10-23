<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Config;
use App\Mail\DegustationPageNotification;
// use App\Mail\DegustationToUserPageNotification;

// use Log;

class DegustationNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validNotificationData = $request->validate([
            'LFP' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'place' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        $localeStr = App::getLocale();
        $degustationNotification = new DegustationPageNotification($validNotificationData);
        /*
         * Precaution: if we use <php artisan config:cache> we don't have any access to env('key') from the code, we must use Config Facade
         */
        $mailTo = Config::get('mail.from.address');
        Mail::to($mailTo)->locale($localeStr)
            ->send($degustationNotification);

        // $degustationToUserNotification = new DegustationToUserPageNotification($validNotificationData);
        // Mail::to($validNotificationData['email'])->locale($localeStr)
        //     ->cc(['steilguttest@gmail.com', 'rockitin.dev@gmail.com'])
        //     ->queue($degustationToUserNotification);

        /* No need extra setup for the task queue */
        // Mail::to($validNotificationData['email'])->locale($localeStr)
        //     ->cc(['steilguttest@gmail.com', 'rockitin.dev@gmail.com'])
        //     ->send($degustationToUserNotification);
    }
}
