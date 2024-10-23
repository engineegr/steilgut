<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WinesIndexResource;
use Illuminate\Http\Request;
use App\Models\Wine;

class HarvestWinesRangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($startNum, $endNum, $harvest, Request $request)
    {
        return WinesIndexResource::collection(
            Wine::harvestRangeWineList($startNum, $endNum, $harvest)->get()
        );
    }
}
