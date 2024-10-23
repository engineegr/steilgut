<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Wine;
use App\Http\Resources\WinesIndexResource;

class WineLowestHarvestPositionContentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $title)
    {
        $locale = App::getLocale();
        $lowestHarvest = Wine::harvestListByTitle($title, $locale)->first();

        $titleList = Wine::titleListByHarvest($lowestHarvest->harvest)->get();
        $pos = -1;
        $id = -1;
        for ($i = 0; $i < $titleList->count() && $pos < 0; $i++) {
            if ($titleList[$i]->title === $title) {
                $pos = $i;
                $id = $titleList[$i]->id;
            }
        }
        if ($pos >= 0) {
            $wineItem = Wine::find($id);
            $itemContent = new WinesIndexResource($wineItem);
            return response()->json([
                'data' => [
                    "pos" => $pos,
                    'harvest' => $lowestHarvest,
                    'item' => $itemContent,
                ],
            ], 200);
        }

        return response()->json([
            "errors" => [
                "404" => "Error [WineLowestHarvestPositionContentController::__invoke] 404 - Data not found",
            ]
        ], 404);

    }
}
