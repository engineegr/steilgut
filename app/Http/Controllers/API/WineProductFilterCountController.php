<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Log;

class WineProductFilterCountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filterArr = json_decode($request->input('filter'), true);
        $filteredWineCountResult = Product::filterWineProductsCount($filterArr);
        $filteredWineSetCountResult = Product::filterWineSetProductsCount($filterArr);
        return response()->json([
            'data' => [
                'count' => ($filteredWineCountResult + $filteredWineSetCountResult)
            ]
        ]);
    }
}
