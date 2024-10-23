<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentPlatform;
use App\Http\Resources\PaymentPlatformIndexResource;

class PaymentPlatformController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return PaymentPlatformIndexResource::collection(PaymentPlatform::all());
    }
}
