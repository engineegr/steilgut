<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\WineProductsIndexResource;
use App\Http\Resources\WineSetProductsIndexResource;

class WineProductRangeController extends Controller
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
        $filteredWineProductsCollectionResult
            = WineProductsIndexResource::collection(
                Product::rangeWineProducts($startNum, $endNum)
                    ->sortBy('productable.harvest')
            );

        $filteredProductCollectionResult = $filteredWineProductsCollectionResult;
        
        $maxCount = $endNum - $startNum + 1;
        $wineCount = $filteredWineProductsCollectionResult->count();
        $restCount = $maxCount - $wineCount;
        if ($wineCount < $maxCount) {
            $filteredWineSetProductsCollectionResult
                = WineSetProductsIndexResource::collection(
                    Product::rangeWineSetProducts(1, $restCount)
                );

            $filteredProductCollectionResult
                = $filteredWineProductsCollectionResult
                ->concat($filteredWineSetProductsCollectionResult);
        }

        return response()->json([
            'data' => $filteredProductCollectionResult->all(),
        ], 200);
    }
}
