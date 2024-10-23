<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wine;
use App\Http\Resources\WinesIndexResource;

class TitleWinesRangeController extends Controller
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
