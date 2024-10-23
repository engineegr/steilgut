<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WineProductsIndexResource;
use App\Http\Resources\WineSetProductsIndexResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Log;

class WineProductFilterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $startNum, $endNum)
    {
        $filteredProductCollectionResult = null;
        $filterArr = json_decode($request->input('filter'), true);
        $filteredWineResult = WineProductsIndexResource::collection(
            Product::filterRangeWineProducts($startNum, $endNum, $filterArr)
                ->get()->sortBy('productable.harvest')
        );

        $filteredProductCollectionResult = $filteredWineResult;
        $maxCount = $endNum - $startNum + 1;
        $wineCount = $filteredWineResult->count();
        $restCount = $maxCount - $wineCount;
        if ($wineCount < $maxCount) {
            $filteredWineSetProductsCollectionResult
                = WineSetProductsIndexResource::collection(
                    Product::filterRangeWineSetProducts(1, $restCount, $filterArr)
                    ->get()->sortBy('productable.min_harvest')
                );

                $filteredProductCollectionResult = $filteredProductCollectionResult->concat($filteredWineSetProductsCollectionResult);
        }
        return response()->json([
            'data' => $filteredProductCollectionResult,
        ], 200);
    }
}
