<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SteilgutHistory;
use App\Http\Resources\SteilgutHistoryIndexResource;

class SteilgutHistoryRangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($startNum, $endNum, Request $request)
    {
        return SteilgutHistoryIndexResource::collection(
            SteilgutHistory::orderBy('year', 'asc')->offset($startNum - 1)->limit($endNum - $startNum + 1)->get()
        );
    }
}
