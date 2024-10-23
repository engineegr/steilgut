<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wine;

class WineHeaderPosController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $title)
    {
        $orderedTitleList = Wine::titleList()->get();
        $pos = -1;

        for ($i = 0; $i < $orderedTitleList->count() && pos < 0; $i++) {
            if ($orderedTitleList[$i]->title === $title) {
                $pos = $i;
            }
        }

        if ($pos >= 0) {
            return response()->json([
                'data' => [
                    "pos" => $pos,
                ],
            ], 200);
        }

        return response()->json([
            "errors" => [
                "404" => "Error [WineHeaderPosController::__invoke] 404 - Data not found",
            ]
        ], 404);
    }
}
