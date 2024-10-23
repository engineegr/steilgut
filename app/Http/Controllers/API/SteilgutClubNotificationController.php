<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Config;
use App\Mail\SteilgutClubPageNotification;

class SteilgutClubNotificationController extends Controller
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
        ]);

        $steilgutClubNotification = new SteilgutClubPageNotification($validNotificationData);
        // Mail::to('rockitin.dev@gmail.com')
        //     ->cc(['steilguttest@gmail.com'])
        //     ->queue($steilgutClubNotification);

        /*
         * Precaution: if we use <php artisan config:cache> we don't have any access to env('key') from the code, we must use Config Facade
         */
        $mailTo = Config::get('mail.from.address');
        /* No need extra setup for the task queue */
        Mail::to($mailTo)
            ->send($steilgutClubNotification);
    }
}
