<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\WineHeadersIndexResource;
use App\Models\Wine;

class WineHeadersRangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($startNum, $endNum, Request $request)
    {
        return WineHeadersIndexResource::collection(
            Wine::rangeHeaderList($startNum, $endNum - $startNum + 1)->get()
        );
    }
}
