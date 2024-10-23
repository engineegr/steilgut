<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WineProductShowResource;
use App\Http\Resources\WineSetProductShowResource;

class WineStoreProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('cart') && $request->input('sync_cart')) {
            $cartValidator = Validator::make($request->all(), [
                'cart.*' => 'required|exists:products,id',
            ]);

            $resultWineCartProducts = null;
            $cartIds = $cartValidator->validated()['cart'];
            $resultWineCartProducts = WineProductShowResource::collection(
                Product::filterCartWineProductList($cartIds)->get()
            );
            $resultWineCartProducts = $resultWineCartProducts->concat(
                WineSetProductShowResource::collection(
                    Product::filterCartWineSetProductList($cartIds)->get()
                )
            );

            if ($resultWineCartProducts->count() > 0) {
                return $resultWineCartProducts;
            } else {
                return response()->json([
                    "errors" => [
                        "404" => "WineProductController: Can't find the passed id"
                    ]
                ], 404);
            }
        }

        return abort(400, "[400] Bad request parameters");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->input('get_total_in_stock')) {
            $aProduct = Product::findOrFail($id);
            return new WineProductInStockTotalShowResource($aProduct);
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    public function cartUpdateTotalInStock(Request $request)
    {
        if ($request->expectsJson()) {
            // ...
            $validateData = $request->validate(['cart' => 'required|array']);

            $cartValidator = Validator::make($request->all(), [
                'cart.*.id' => 'required|exists:products,id',
            ]);

            $resultCart = array();
            $validatedCart = $cartValidator->validated()['cart'];

            foreach ($validatedCart as $key => $value) {
                $productCollection = Product::findOrFail($value);
                if ($productCollection->count() !== 1) {
                    if ($productCollection->count() === 0) {
                        return response()->json([
                            'data' =>
                            [
                                'errors' => ['is404' => 'Error. Product with id ' . $value . ' is absent'],
                            ]
                        ]);
                    } else {
                        return response()->json([
                            'data' =>
                            [
                                'errors' => ['is404' => 'Error. Product with id ' . $value . ' is more than 1'],
                            ]
                        ]);
                    }
                }
                $aProduct = $productCollection->first();
                $resultCart[$key] = $aProduct->total_in_stock;
            }

            return response()->json([
                'data' =>
                ['cart' => $resultCart]
            ]);
        } else {
            return abort(500, 'Error. Wrong request format, it must be JSON AcceptType');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
