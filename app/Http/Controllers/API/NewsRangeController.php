<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsIndexResource;
use Illuminate\Http\Request;
use App\Models\News;

class NewsRangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($startNum, $endNum, Request $request)
    {
        return NewsIndexResource::collection(
            News::orderBy('posting_date', 'desc')->offset($startNum - 1)->limit($endNum - $startNum + 1)->get()
        );
    }
}
