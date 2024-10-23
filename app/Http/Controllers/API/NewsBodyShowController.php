<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Resources\NewsBodyShowResource;

class NewsBodyShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $aNewsItem = News::findOrFail($id);
        return new NewsBodyShowResource($aNewsItem);
    }
}
