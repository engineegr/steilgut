<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wine;

class WineAttributesByHarvestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($harvest, $pos, $num, $attribute, Request $request)
    {
        $harvestWineAttributes = Wine::posAttributesByHarvest($harvest, $pos, $num, $attribute);
        return response()->json([
            'data' => [
                'wine_pos_attributes' => $harvestWineAttributes,
                'status' => 200,
            ],
        ], 200);
    }
}
