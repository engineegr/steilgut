<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderData;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Config;

class OrderNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $orderData = OrderData::findOrFail($id);
        $p = $orderData->person;
        $orderShipped = new OrderShipped($orderData);
        $localeStr = App::getLocale();
        // Mail::to($p->email)
        //     ->cc(['rockitin.dev@gmail.com', 'steilguttest@gmail.com'])
        //     ->locale($localeStr)
        //     ->queue($orderShipped);

        /*
         * Precaution: if we use <php artisan config:cache> we don't have any access to env('key') from the code, we must use Config Facade
         */
        $mailTo = Config::get('mail.from.address');
        /* No need extra setup for the task queue */
        Mail::to($p->email)
            ->cc('rockitin.dev@gmail.com')
            // ->cc($mailTo)
            ->locale($localeStr)
            ->send($orderShipped);
    }
}
