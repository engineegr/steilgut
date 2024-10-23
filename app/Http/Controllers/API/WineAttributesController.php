<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wine;

class WineAttributesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($pos, $num, $attribute, Request $request)
    {
        $wineAttributes = Wine::posAttributes($pos, $num, $attribute);
        return response()->json([
            'data' => [
                'wine_pos_attributes' => $wineAttributes,
                'status' => 200,
            ],
        ], 200);
    }
}
