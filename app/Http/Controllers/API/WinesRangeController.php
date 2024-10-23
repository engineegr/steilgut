<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WinesIndexResource;
use Illuminate\Http\Request;
use App\Models\Wine;

class WinesRangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($startNum, $endNum, $title, Request $request)
    {
        return WinesIndexResource::collection(
            Wine::titleRangeWineList($startNum, $endNum, $title)->get()
        );
    }
}
